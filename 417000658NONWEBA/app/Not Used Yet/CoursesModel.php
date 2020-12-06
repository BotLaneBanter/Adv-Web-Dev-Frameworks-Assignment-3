<?php 

class CoursesModel extends Observable_Model{

public function getAll() : array {

 //Get all contents of user_courses.json file
 $courses = $this->loadData(DATA_DIR . '/courses.json');
 $instructors = $this->loadData(DATA_DIR . '/instructors.json');
 $courseInstructor = $this->loadData(DATA_DIR . '/course_instructor.json');
 $facultyDepartment = $this->loadData(DATA_DIR . '/faculty_department.json');
 $facultyDeptCourses = $this->loadData(DATA_DIR . '/faculty_dept_courses.json');


 //Start a new session and check if the user can be on this page
 $session = new SessionManager();

 //Variable arrays to store retrieved info
 $courseTitle = "";
 $courseImage = "";
 $courseFaculty = "";
 $courseInstructorName = "";

 //Array to be returned
 $coursesData = [];

 if(isset($_SESSION)){
 //Get the specific user array of courseIDs
 $courseData = $courses['courses'];
 
 //Will iterate over each value in the internal array of courseIDs
 //Populating the values for each course
 foreach($courseData as $key => $value){

    //Course ID from within the courses.json file
    $courseKey = $key;

     //Get the course title and image name
     //Value is the courseID
     $courseTitle = $courseData[$courseKey][0];
     $courseImage = $courseData[$courseKey][4];

     //Create variable to hold the departmentIDs
     $departmentID = "";
     
     //Assign department the inner array of faculty_dept_courses
     $department = $facultyDeptCourses["faculty_dept_courses"];

     //Search the array, and check each position in the internal arrays (6 of them, like the file) 
     //to see if the department ID is in the array ( in_array() ) If it is, assign that key to departmentID
     foreach($department as $key => $unused){

         if(in_array($courseKey, $department[$key])){
             $departmentID = $key;
         }

     }

     //Get the faculty/department of the course
     $courseFaculty = $facultyDepartment["faculty_department"][$departmentID];

     //Get the instructor for the course
     $instructorID = $courseInstructor["course_instructor"][$courseKey];
     //Get the name from the instructors array using the corresponding instructor ID
     $courseInstructorName = $instructors["instructors"][$instructorID];

     //Push the data gathered as an array into the array
     $coursesData[] = [$courseTitle, $courseImage, $courseFaculty, $courseInstructorName];


 }//END OF FOREACH LOOP

 return ['courses' => $coursesData];
}

 //Return an associative multidimensional array of blank fields if a session is not set
 return ['courses' => ["","","",""]];

}

public function getRecord(string $id) : array {

    return [];

}


}
?>