<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for template
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Log;

class Test extends Controller {

    public function __construct() {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');

        //admin
        $this->middleware('adminCheck');
    }

    /**
     * @return blade view | ajax view
     * - position 11 | 21 | 31 | 41 | 51 | 61 | 71
     * - datatype text date paragraph checkbox dropdown number decimal
     * - limit 10
     * - task client project
     *
     */
    public function index() {

        DB::statement('
        DELETE a
        FROM projects_assigned a
        INNER JOIN (
          SELECT projectsassigned_userid, projectsassigned_projectid, MIN(projectsassigned_id) AS min_id
          FROM projects_assigned
          GROUP BY projectsassigned_userid, projectsassigned_projectid
        ) b ON a.projectsassigned_userid = b.projectsassigned_userid
          AND a.projectsassigned_projectid = b.projectsassigned_projectid
          AND a.projectsassigned_id <> b.min_id;');

        dd('done');
    }

}