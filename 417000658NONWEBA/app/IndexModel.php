<?php 

namespace app\handlers;
use QuwisSystem\Framework\Observable_Model;

class IndexModel extends Observable_Model{

    public function findAll() : array {

        //Create mysqli queries to fetch the popular and recommended courses
        //Popular courses

        //Construct query to fetch popular courses
        $popularCoursesSQL = "SELECT course_access_count FROM courses";
        $checkPopularCourses = mysqli_query($this->db, $popularCoursesSQL);

        //Fetch records and convert them to integers from strings
        $popularColumn = [];

        while($result = $checkPopularCourses->fetch_assoc()){
            $popularColumn[] = intval($result['course_access_count']);
        }


        //Recommended courses

        //Construct query to fetch recommended courses
        $recommendedCoursesSQL = "SELECT course_recommendation_count FROM courses";
        $checkRecommendedCourses = mysqli_query($this->db, $recommendedCoursesSQL);

        //Fetch records and convert them to integers from strings
        $recommendedColumn = [];

        while($result = $checkRecommendedCourses->fetch_assoc()){
            $recommendedColumn[] = intval($result['course_recommendation_count']);
        }

        //Get all contents of the courses table
        $coursesSQL = "SELECT * FROM courses";
        $checkCourses = mysqli_query($this->db, $coursesSQL);

        //Fetch records and convert them to integers from strings where necessary
        $coursesData = [];

        while($result = $checkCourses->fetch_assoc()){
            $coursesData[] = [ intval($result['course_id']), 
                               $result['course_name'], 
                               $result['course_description'], 
                               intval($result['course_recommendation_count']),
                               intval($result['course_access_count']), 
                               $result['course_image'] ];
        }

        //Courses data
        $extra = $coursesData;

        //Sort data based on recommended
        array_multisort($recommendedColumn, SORT_DESC, $coursesData);
        //Return values from coursesData from position 0 to 8
        $recommendedCourses = array_slice($coursesData, 0, 8);
        //Sort based on recommended
        array_multisort($popularColumn, SORT_DESC, $coursesData);
        //Return values from extra from position 0 to 8
        $popularCourses = array_slice($extra, 0, 8);

        //Return an associative multidimensional array of popular and recommended courses
        return ['popular' => $popularCourses, 'recommended' => $recommendedCourses];

    }

    public function findRecord(string $id) : array {

        return [];

    }


}

?>