<?php

namespace App\Console\Commands;

use App\Http\Models\Courses;
use App\Http\Models\Teacher;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:migrate_data {table=courses : Type of user ex: admin, user...}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start_time = time();
        $table = $this->argument('table');
        $total = 0;
        $dbOld = DB::connection('mysql_old');
        switch ($table) {
            case 'course':
                $listCoursesOld = $dbOld->table('training_courses')->get();
                if (!empty($listCoursesOld)) {
                    $mappingTeacher = array(
                        10 => 5,
                        11 => 3
                    );
                    $mappingCategory = array(
                        1 => 1000001,
                        2 => 1000007,
                        3 => 1000008,
                    );
                    foreach ($listCoursesOld as $course) {
                        $teacher_id = isset($mappingTeacher[$course->teacher_id]) ? $mappingTeacher[$course->teacher_id] : 5;
                        $data = array(
                            'name' => $course->name,
                            'courseid_old' => $course->id,
                            'category_id' => $mappingCategory[$course->category_id],
                            'category_fullparent' => $mappingCategory[$course->category_id],
                            'catelist' => $mappingCategory[$course->category_id],
                            'share_url' => str_slug($course->name),
                            'description' => $course->summary,
                            'content' => $course->content,
                            'teacher_id' => $teacher_id,
                            'price' => 0,
                            'images' => '/img/upload/courses/' . $course->picture,
                            'price_old' => 0,
                            'start_sale' => null,
                            'end_sale' => null,
                            'publish_time' => $course->created,
                            'status' => ($course->status == 1) ? 1 : 2,
                            'create_time' => $course->created,
                            'meta_keyword' => $course->name,
                            'meta_title' => $course->seo_title,
                            'meta_description' => $course->seo_description,
                        );

                        Courses::create($data);
                        $this->info("course_id = " . $course->id);
                        $total++;
                    }
                }
                break;
            case 'teacher':
                $listTeachersOld = $dbOld->table('training_teacher_supporter')->get();
                if (!empty($listTeachersOld)) {
                    foreach ($listTeachersOld as $teacher) {
                        $data = array(
                            'username' => $teacher->email,
                            'fullname' => $teacher->full_name,
                            'phone' => $teacher->phone,
                            'status' => $teacher->status,
                            'address' => $teacher->address,
                            'description' => $teacher->experience,
                            'content' => $teacher->experience,
                            'cmnd' => '',
                            'avatar' => '/img/upload/teacher/' . $teacher->picture,
                            'info' => $teacher->skills,
                            'created_by' => null,
                            'created_time' => $teacher->registered,
                        );
                        $id_teacher = Teacher::create($data);
                        $this->info($id_teacher . ' - Migrate Data ON table Course - PARAM IS OK');
                        $total++;
                    }
                }
                break;
            case 'category' :

                break;
            case 'users' :
                $offset = 0;
                $limit = 100;
                $i = 0;
                do {
                    $listUsersOld = $dbOld->table('training_users')->skip($offset * $limit)->take($limit)->get();
                    if (!empty($listUsersOld)) {
                        foreach ($listUsersOld as $user) {
                            $i++;
                            $this->info("/n" . $i . ' ======================> ' . $user->id);
                            $data = array(
                                'username' => $user->user_name,
                                'fullname' => $user->first_name . ' ' . $user->last_name,
                                'email' => $user->email,
                                'password_old' => $user->password,
                                'id_old' => $user->id,
                                'group_id' => 1000003,
                                'register_date' => $user->register_date,
                                'birthday' => ($user->birthday != '') ? (date('Y-m-d', strtotime($user->birthday))) : null,
                            );
                            User::create($data);
                            if ($i % 10 == 0) {
                                sleep(1);
                            }
                        }
                    }
                    $offset++;
                } while (count($listUsersOld) > 0);
                break;

            case 'students' :
                $offset = 0;
                $limit = 100;
                $i = 0;

                $listStudentsOld = $dbOld->table('training_students')->skip($offset * $limit)->take($limit)->get();
                if (!empty($listStudentsOld)) {
                    foreach ($listStudentsOld as $student) {

                        $this->info("/n" . $i . ' ======================> ' . json_encode($student));

                    }
                }

                /*do {
                    $listUsersOld = $dbOld->table('training_students')->skip($offset * $limit)->take($limit)->get();
                    if (!empty($listUsersOld)) {
                        foreach ($listUsersOld as $user) {
                            $i++;
                            $this->info("/n" . $i . ' ======================> ' . $user->id);

                        }
                    }
                    $offset++;
                } while (count($listUsersOld) > 0);*/
                break;
            default:
                $this->info('Not found table - PARAM INVALID');
                break;
        }

        $end_time = time();
        $this->info(' - Migrate Data ON table Course - DONE - Có : ' . $total . ' dữ liệu được clone về');
        $this->info("Tốn khoảng :" . ($end_time - $start_time) . " giây thực hiện");

        /*for ($i = 1; $i < 100; $i++) {
            $this->info($numberOfUser . ($userTypeId == 1) ? ' administrators' : ' users' . ' create success.');
            sleep(2);
        }*/
    }
}
