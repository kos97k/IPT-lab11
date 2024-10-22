<?php

namespace App\Models;

use App\Models\BaseModel;
use \PDO;

class CourseEnrolment extends BaseModel
{
    
    public function enroll($course_code, $student_code, $enrollment_date)
    {
        $sql = "INSERT INTO course_enrollments (course_code, student_code, enrolment_date) 
                VALUES (:course_code, :student_code, :enrollment_date)";
        $statement = $this->db->prepare($sql);

        try {
            $statement->execute([
                'course_code' => $course_code,
                'student_code' => $student_code,
                'enrollment_date' => $enrollment_date
            ]);
        } catch (\PDOException $e) {
            
            throw new \Exception("Error enrolling student: " . $e->getMessage());
        }
    }

    
    public function all()
    {
        $sql = "SELECT * FROM course_enrollments";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_CLASS, '\App\Models\CourseEnrolment');
        return $result;
    }
}
