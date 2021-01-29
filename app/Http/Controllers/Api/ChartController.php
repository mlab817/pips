<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FsInvestment;
use App\Models\FundingSource;
use App\Models\OperatingUnit;
use App\Models\PapType;
use App\Models\Project;
use App\Models\Region;
use App\Models\SpatialCoverage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function regions(): JsonResponse
    {
        $regions = Region::all()->pluck('project_count','label');

        return response()->json([
            'original'      => $regions,
            'title'         => 'Number of Projects by Region',
            'categories'    => $regions->keys(),
            'data'          => $regions->values(),
        ]);
    }

    public function funding_sources(): JsonResponse
    {
        $fs = FundingSource::all();

        return response()->json($fs);
    }

    public function pip_by_spatial_coverage()
    {
        $data = DB::table('spatial_coverages')
            ->selectRaw('
                spatial_coverages.name AS label,
                COUNT(projects.id) AS project_count,
                IFNULL(SUM(fs_investments.y2016),0) AS "2016",
                IFNULL(SUM(fs_investments.y2017),0) AS "2017",
                IFNULL(SUM(fs_investments.y2018),0) AS "2018",
                IFNULL(SUM(fs_investments.y2019),0) AS "2019",
                IFNULL(SUM(fs_investments.y2020),0) AS "2020",
                IFNULL(SUM(fs_investments.y2021),0) AS "2021",
                IFNULL(SUM(fs_investments.y2022),0) AS "2022",
                IFNULL(SUM(fs_investments.y2023),0) AS "2023",
                IFNULL(SUM(fs_investments.y2024),0) AS "2024",
                IFNULL(SUM(fs_investments.y2025),0) AS "2025",
                IFNULL(SUM(fs_investments.y2016+fs_investments.y2017+fs_investments.y2018+fs_investments.y2019+fs_investments.y2020+fs_investments.y2021+fs_investments.y2022+fs_investments.y2023+fs_investments.y2024+fs_investments.y2025),0) AS total
            ')
            ->leftJoin('projects','spatial_coverages.id','=','projects.spatial_coverage_id')
            ->leftJoin('fs_investments', 'fs_investments.project_id','=','projects.id')
            ->whereNull('projects.deleted_at')
            ->groupBy('spatial_coverages.id')
            ->get();

        return response()->json([
            'original'  => $data,
            'title'     => 'Investment Requirement by Year by Spatial Coverage',
            'categories'=> $data->pluck('name'),
        ]);
    }

    public function spatial_coverages(): JsonResponse
    {
        $data = DB::table('spatial_coverages')
            ->selectRaw('
                spatial_coverages.name,
                COUNT(projects.id) AS project_count,
                SUM(fs_investments.y2016+fs_investments.y2017+fs_investments.y2018+fs_investments.y2019+fs_investments.y2020+fs_investments.y2021+fs_investments.y2022+fs_investments.y2023+fs_investments.y2024+fs_investments.y2025) AS total
            ')
            ->leftJoin('projects','spatial_coverages.id','=','projects.spatial_coverage_id')
            ->leftJoin('fs_investments', 'fs_investments.project_id','=','projects.id')
            ->whereNull('projects.deleted_at')
            ->groupBy('spatial_coverages.id')
            ->get();

        return response()->json([
            'original'      => $data,
            'title'         => 'Number of Projects by Spatial Coverage',
            'categories'    => $data->pluck('name'),
            'data'          => $data,
        ]);
    }

    public function pap_types(): JsonResponse
    {
        $data = PapType::all()->pluck('project_count', 'name');

        return response()->json([
            'original'      => $data,
            'title'         => 'Number of Projects by PAP Type',
            'categories'    => $data->keys(),
            'data'          => $data->values(),
        ]);
    }

    public function implementation_start(): JsonResponse
    {
        $data = DB::table('projects')
            ->select(DB::raw('count(id) as project_count, target_start_year'))
            ->whereNotNull('target_start_year')
            ->whereNull('deleted_at')
            ->groupBy('target_start_year')
            ->orderBy('target_start_year','ASC')
            ->get()
            ->pluck('project_count','target_start_year');

        return response()->json([
            'original'      => $data,
            'title'         => 'Number of Projects by Implementation Start',
            'categories'    => $data->keys(),
            'data'          => $data->values(),
        ]);
    }

    public function main_funding_source(): JsonResponse
    {
        $data = DB::table('projects')
            ->select(DB::raw('count(projects.id) as project_count, funding_source_id, funding_sources.name AS label'))
            ->leftJoin('funding_sources','projects.funding_source_id','=','funding_sources.id')
            ->whereNotNull('funding_source_id')
            ->whereNull('deleted_at')
            ->groupBy('funding_source_id')
            ->orderBy('funding_source_id','ASC')
            ->get()
            ->pluck('project_count','label');

        return response()->json([
            'original'      => $data,
            'title'         => 'Number of Projects by Main Funding Source',
            'categories'    => $data->keys(),
            'data'          => $data->values(),
        ]);
    }

    public function office(): JsonResponse
    {
        $data = DB::table('projects')
            ->select(DB::raw('count(projects.id) as project_count, office_id, offices.acronym AS label'))
            ->rightJoin('offices','projects.office_id','=','offices.id')
            ->whereNotNull('office_id')
            ->whereNull('deleted_at')
            ->groupBy('office_id')
            ->orderBy('project_count','DESC')
            ->get()
            ->pluck('project_count','label');

        return response()->json([
            'original'      => $data,
            'title'         => 'Number of Projects by Office',
            'categories'    => $data->keys(),
            'data'          => $data->values(),
        ]);
    }

    public function pip(): JsonResponse
    {
        $data = DB::table('projects')
            ->select(DB::raw('count(projects.id) as project_count, pip as label'))
            ->whereNull('deleted_at')
            ->groupBy('pip')
            ->orderBy('project_count','DESC')
            ->get()
            ->pluck('project_count','label');

        return response()->json([
            'original'      => $data,
            'title'         => 'Number of Projects by PIP',
            'categories'    => $data->keys(),
            'data'          => $data->values(),
        ]);
    }

    public function by_outcome()
    {
        //
    }

    public function pip_by_office(): JsonResponse
    {
        $data = DB::table('offices')
            ->leftJoin('projects','projects.office_id','=','offices.id')
            // ->select(DB::raw('count(projects.id) as project_count, office_id, offices.acronym AS label'))
            ->leftJoin('fs_investments','fs_investments.project_id','=','projects.id')
            ->selectRaw('
                offices.acronym AS label,
                COUNT(projects.id) AS project_count,
                IFNULL(SUM(fs_investments.y2016),0) AS "2016",
                IFNULL(SUM(fs_investments.y2017),0) AS "2017",
                IFNULL(SUM(fs_investments.y2018),0) AS "2018",
                IFNULL(SUM(fs_investments.y2019),0) AS "2019",
                IFNULL(SUM(fs_investments.y2020),0) AS "2020",
                IFNULL(SUM(fs_investments.y2021),0) AS "2021",
                IFNULL(SUM(fs_investments.y2022),0) AS "2022",
                IFNULL(SUM(fs_investments.y2023),0) AS "2023",
                IFNULL(SUM(fs_investments.y2024),0) AS "2024",
                IFNULL(SUM(fs_investments.y2025),0) AS "2025",
                IFNULL(SUM(fs_investments.y2016+fs_investments.y2017+fs_investments.y2018+fs_investments.y2019+fs_investments.y2020+fs_investments.y2021+fs_investments.y2022+fs_investments.y2023+fs_investments.y2024+fs_investments.y2025),0) AS total
            ')
            ->whereNotNull('office_id')
            ->whereNull('deleted_at')
            ->groupBy('office_id')
            ->orderBy('label','ASC')
            ->get();

        return response()->json([
            'original'      => $data,
            'title'         => 'Number of Projects by Office',
            'categories'    => $data->keys(),
            'data'          => $data->values(),
        ]);
    }

    public function cip_by_office(): JsonResponse
    {
        $data = DB::table('offices')
            ->leftJoin('projects','projects.office_id','=','offices.id')
            // ->select(DB::raw('count(projects.id) as project_count, office_id, offices.acronym AS label'))
            ->leftJoin('fs_investments','fs_investments.project_id','=','projects.id')
            ->selectRaw('
                offices.acronym AS label,
                COUNT(projects.id) AS project_count,
                IFNULL(SUM(fs_investments.y2016),0) AS "2016",
                IFNULL(SUM(fs_investments.y2017),0) AS "2017",
                IFNULL(SUM(fs_investments.y2018),0) AS "2018",
                IFNULL(SUM(fs_investments.y2019),0) AS "2019",
                IFNULL(SUM(fs_investments.y2020),0) AS "2020",
                IFNULL(SUM(fs_investments.y2021),0) AS "2021",
                IFNULL(SUM(fs_investments.y2022),0) AS "2022",
                IFNULL(SUM(fs_investments.y2023),0) AS "2023",
                IFNULL(SUM(fs_investments.y2024),0) AS "2024",
                IFNULL(SUM(fs_investments.y2025),0) AS "2025",
                IFNULL(SUM(fs_investments.y2016+fs_investments.y2017+fs_investments.y2018+fs_investments.y2019+fs_investments.y2020+fs_investments.y2021+fs_investments.y2022+fs_investments.y2023+fs_investments.y2024+fs_investments.y2025),0) AS total
            ')
            ->where('projects.cip',true)
            ->whereNotNull('office_id')
            ->whereNull('deleted_at')
            ->groupBy('office_id')
            ->orderBy('label','ASC')
            ->get();

        return response()->json([
            'original'      => $data,
            'title'         => 'Number of Projects by Office',
            'categories'    => $data->keys(),
            'data'          => $data->values(),
        ]);
    }

    public function cip_by_spatial_coverage(): JsonResponse
    {
        $data = DB::table('spatial_coverages')
            ->leftJoin('projects','spatial_coverages.id','=','projects.spatial_coverage_id')
            ->leftJoin('fs_investments', 'fs_investments.project_id','=','projects.id')
            ->selectRaw('
                spatial_coverages.name AS label,
                COUNT(projects.id) AS project_count,
                IFNULL(SUM(fs_investments.y2016),0) AS "2016",
                IFNULL(SUM(fs_investments.y2017),0) AS "2017",
                IFNULL(SUM(fs_investments.y2018),0) AS "2018",
                IFNULL(SUM(fs_investments.y2019),0) AS "2019",
                IFNULL(SUM(fs_investments.y2020),0) AS "2020",
                IFNULL(SUM(fs_investments.y2021),0) AS "2021",
                IFNULL(SUM(fs_investments.y2022),0) AS "2022",
                IFNULL(SUM(fs_investments.y2023),0) AS "2023",
                IFNULL(SUM(fs_investments.y2024),0) AS "2024",
                IFNULL(SUM(fs_investments.y2025),0) AS "2025",
                IFNULL(SUM(fs_investments.y2016+fs_investments.y2017+fs_investments.y2018+fs_investments.y2019+fs_investments.y2020+fs_investments.y2021+fs_investments.y2022+fs_investments.y2023+fs_investments.y2024+fs_investments.y2025),0) AS total
            ')
            ->where('cip', true)
            ->whereNull('projects.deleted_at')
            ->groupBy('spatial_coverages.id')
            ->get();

        return response()->json([
            'original'  => $data,
            'title'     => 'Investment Requirement by Year by Spatial Coverage',
            'categories'=> $data->pluck('label'),
        ]);
    }

    public function pip_by_implementation_mode(): JsonResponse
    {
        $data = DB::table('implementation_modes')
            ->leftJoin('projects','implementation_modes.id','=','projects.implementation_mode_id')
            ->leftJoin('fs_investments', 'fs_investments.project_id','=','projects.id')
            ->selectRaw('
                implementation_modes.name AS label,
                COUNT(projects.id) AS project_count,
                IFNULL(SUM(fs_investments.y2016),0) AS "2016",
                IFNULL(SUM(fs_investments.y2017),0) AS "2017",
                IFNULL(SUM(fs_investments.y2018),0) AS "2018",
                IFNULL(SUM(fs_investments.y2019),0) AS "2019",
                IFNULL(SUM(fs_investments.y2020),0) AS "2020",
                IFNULL(SUM(fs_investments.y2021),0) AS "2021",
                IFNULL(SUM(fs_investments.y2022),0) AS "2022",
                IFNULL(SUM(fs_investments.y2023),0) AS "2023",
                IFNULL(SUM(fs_investments.y2024),0) AS "2024",
                IFNULL(SUM(fs_investments.y2025),0) AS "2025",
                IFNULL(SUM(fs_investments.y2016+fs_investments.y2017+fs_investments.y2018+fs_investments.y2019+fs_investments.y2020+fs_investments.y2021+fs_investments.y2022+fs_investments.y2023+fs_investments.y2024+fs_investments.y2025),0) AS total
            ')
            ->whereNull('projects.deleted_at')
            ->groupBy('implementation_modes.id')
            ->get();

        return response()->json([
            'original'  => $data,
            'title'     => 'Investment Requirement by Year by Spatial Coverage',
            'categories'=> $data->pluck('label'),
        ]);
    }

    public function cip_by_implementation_mode(): JsonResponse
    {
        $data = DB::table('implementation_modes')
            ->leftJoin('projects','implementation_modes.id','=','projects.implementation_mode_id')
            ->leftJoin('fs_investments', 'fs_investments.project_id','=','projects.id')
            ->selectRaw('
                implementation_modes.name AS label,
                COUNT(projects.id) AS project_count,
                IFNULL(SUM(fs_investments.y2016),0) AS "2016",
                IFNULL(SUM(fs_investments.y2017),0) AS "2017",
                IFNULL(SUM(fs_investments.y2018),0) AS "2018",
                IFNULL(SUM(fs_investments.y2019),0) AS "2019",
                IFNULL(SUM(fs_investments.y2020),0) AS "2020",
                IFNULL(SUM(fs_investments.y2021),0) AS "2021",
                IFNULL(SUM(fs_investments.y2022),0) AS "2022",
                IFNULL(SUM(fs_investments.y2023),0) AS "2023",
                IFNULL(SUM(fs_investments.y2024),0) AS "2024",
                IFNULL(SUM(fs_investments.y2025),0) AS "2025",
                IFNULL(SUM(fs_investments.y2016+fs_investments.y2017+fs_investments.y2018+fs_investments.y2019+fs_investments.y2020+fs_investments.y2021+fs_investments.y2022+fs_investments.y2023+fs_investments.y2024+fs_investments.y2025),0) AS total
            ')
            ->whereNull('projects.deleted_at')
            ->where('projects.cip', true)
            ->groupBy('implementation_modes.id')
            ->get();

        return response()->json([
            'original'  => $data,
            'title'     => 'Investment Requirement by Year by Spatial Coverage',
            'categories'=> $data->pluck('label'),
        ]);
    }

    public function pip_by_main_pdp_chapter(): JsonResponse
    {
        $data = DB::table('pdp_chapters')
            ->leftJoin('projects','projects.pdp_chapter_id','=','pdp_chapters.id')
            ->leftJoin('fs_investments', 'fs_investments.project_id','=','projects.id')
            ->selectRaw('
                pdp_chapters.name AS label,
                COUNT(projects.id) AS project_count,
                IFNULL(SUM(fs_investments.y2016),0) AS "2016",
                IFNULL(SUM(fs_investments.y2017),0) AS "2017",
                IFNULL(SUM(fs_investments.y2018),0) AS "2018",
                IFNULL(SUM(fs_investments.y2019),0) AS "2019",
                IFNULL(SUM(fs_investments.y2020),0) AS "2020",
                IFNULL(SUM(fs_investments.y2021),0) AS "2021",
                IFNULL(SUM(fs_investments.y2022),0) AS "2022",
                IFNULL(SUM(fs_investments.y2023),0) AS "2023",
                IFNULL(SUM(fs_investments.y2024),0) AS "2024",
                IFNULL(SUM(fs_investments.y2025),0) AS "2025",
                IFNULL(SUM(fs_investments.y2016+fs_investments.y2017+fs_investments.y2018+fs_investments.y2019+fs_investments.y2020+fs_investments.y2021+fs_investments.y2022+fs_investments.y2023+fs_investments.y2024+fs_investments.y2025),0) AS total
            ')
            ->whereNull('projects.deleted_at')
            ->groupBy('pdp_chapters.id')
            ->get();

        return response()->json([
            'original'  => $data,
            'title'     => 'Investment Requirement by Year by Main PDP Chapter',
            'categories'=> $data->pluck('label'),
        ]);
    }
}
