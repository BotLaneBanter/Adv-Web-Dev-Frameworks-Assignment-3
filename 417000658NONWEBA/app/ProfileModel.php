<?php 

namespace app\handlers;
use QuwisSystem\Framework\Observable_Model;
use QuwisSystem\Framework\SessionManager;
use QuwisSystem\Framework\Registry;

class ProfileModel extends Observable_Model{

public function findAll() : array {

    //Get all contents of user_courses.json file
    $userCourses = $this->loadData(DATA_DIR . '/user_courses.json');
    $courses = $this->loadData(DATA_DIR . '/courses.json');
    $instructors = $this->loadData(DATA_DIR . '/instructors.json');
    $courseInstructor = $this->loadData(DATA_DIR . '/course_instructor.json');
    $facultyDepartment = $this->loadData(DATA_DIR . '/faculty_department.json');
    $facultyDeptCourses = $this->loadData(DATA_DIR . '/faculty_dept_courses.json');


    //Start a new session and check if the user can be on this page
    $registry = Registry::getInstance();
    $session = $registry->getSession();

    //Variable arrays to store retrieved info
    $courseTitle = "";
    $courseImage = "";
    $courseFaculty = "";
    $courseInstructorName = "";

    //Array to be returned
    $userCourseData = [];

    if(isset($_SESSION)){


            //Get the specific user array of courseIDs
            $userData = $userCourses['user_courses'][$session->receive("Email")];
            
            //Will iterate over each value in the internal array of courseIDs
            //Populating the values for each course
            foreach($userData["courseID"] as $key => $value){

                //Get the course title and image name
                //Value is the courseID
                $courseTitle = $courses["courses"][$value][0];
                $courseImage = $courses["courses"][$value][4];

                //Create variable to hold the departmentIDs
                $departmentID = "";
                
                //Assign department the inner array of faculty_dept_courses
                $department = $facultyDeptCourses["faculty_dept_courses"];

                //Search the array, and check each position in the internal arrays (6 of them, like the file) 
                //to see if the department ID is in the array ( in_array() ) If it is, assign that key to departmentID
                foreach($department as $key => $unused){

                    if(in_array($value, $department[$key])){
                        $departmentID = $key;
                    }

                }

                //Get the faculty/department of the course
                $courseFaculty = $facultyDepartment["faculty_department"][$departmentID];

                //Get the instructor for the course
                $instructorID = $courseInstructor["course_instructor"][$value];
                //Get the name from the instructors array using the corresponding instructor ID
                $courseInstructorName = $instructors["instructors"][$instructorID];

                //Push the data gathered as an array into the array
                $userCourseData[] = [$courseTitle, $courseImage, $courseFaculty, $courseInstructorName];


            }//END OF FOREACH LOOP

        return ['user_courses' => $userCourseData];
    
        }


    //Return an associative multidimensional array of blank fields if a session is not set
    return ['user_courses' => ["","","",""]];

}

public function findRecord(string $id) : array {

    return [];

}


}
?>