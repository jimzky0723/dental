<?php

class Book extends Model
{
    protected $table;
    public function __construct(){
        $this->table = 'tblbook';
        $_SESSION['table'] = 'tblbook';
    }
    
    public function getName($id){
        $q = "SELECT * FROM $this->table where id=$id";
        $r = $this->db()->query($q);
        $row = $r->fetch_object();
        return $row->categoryName;
    }
    
    function getAvailable(){
        $table = $_SESSION['table'];
        $q = "select * from $table where status=0 order by id desc";
        return $this->db()->query($q);
    }
    
    function getBorrowedBooks(){
        $table = 'tblborrowedbook';
        $q = "select * from $table where status='Borrowed' order by dateborrowed desc";
        return $this->db()->query($q);
    }

    function getReturnedBooks(){
        $table = 'tblreturnedbook';
        $q = "select * from $table order by dateBorrowed desc";
        return $this->db()->query($q);
    }
    
    function updateStatus($id,$status){
        $c = new Controller();
        $data =  array(
            'currentID' => $id,
            'update' => '',
            'delete' => '',
            'status' => $status,
        );
        $c->update($data);
    }
    
    function addBorrow($data){
        $_SESSION['table'] = 'tblborrowedbook';
        $c = new Controller();
        $c->save($data);
    }
    
    function returnBook($id){
        $_SESSION['table'] = 'tblborrowedbook';
        $c = new Controller();
        $data = array(
            'currentID' => $id,
            'status' => 'Returned',
            'dateReturned' => date('Y-m-d'),
            'receivedBy' => $_COOKIE['id']
        );
        $c->update($data);
        //get information of borrowed book
        $info = $c->info($id);
        $_SESSION['table'] = 'tblborrower';
        $borrower = $c->info($info->borrowerID);
        $_SESSION['table'] = 'tblbook';
        $book = $c->info($info->bookID);

        $duration = $this->calculateFine(strtotime($info->dueDate));
        $data = array(
            'bookTitle' => $book->bookTitle,
            'borrower' => $borrower->fname.' '.$borrower->mname.' '.$borrower->lname,
            'category' => $borrower->category,
            'dateBorrowed' => $info->dateborrowed,
            'dateReturned' => date('Y-m-d'),
            'fine' => $duration['amount'],
            'late' => $duration['days']
        );
        $_SESSION['table'] = 'tblreturnedbook';
        $c->save($data);

    }
    
    function getInfo($id){
        $c = new Controller();
        return $c->info($id);
    }

    function calculateFine($date){
        $start_date = date('Y-m-d H:i:s',$date);
        $days = $this->duration($start_date);
        $data = array();
        if($days > 0){
            $data['days'] = $days;
            $data['amount'] = number_format($this->checkFine($days),2);
            return $data;
        }else{
            $data['days'] = 0;
            $data['amount'] = '0.00';
            return $data;
        }
    }

    function checkFine($days){
        $c = new Controller();
        $_SESSION['table'] = 'tblsettings';
        $r = $c->records();
        if($r->num_rows > 0){
            $fine = $r->fetch_object()->fine;
            return $days * $fine;
        }
        return 0;
    }

    function duration($start_date)
    {
        $end_date=date('Y-m-d H:i:s');

        $start_time = strtotime($start_date);
        $end_time = strtotime($end_date);
        if($start_time > $end_time){

        }
        $difference = $end_time - $start_time;

        $seconds = $difference % 60;            //seconds
        $difference = floor($difference / 60);

        $min = $difference % 60;              // min
        $difference = floor($difference / 60);

        $hours = $difference % 24;  //hours
        $difference = floor($difference / 24);

        $days = $difference % 30;  //days
        $difference = floor($difference / 30);

        $month = $difference % 12;  //month
        $difference = floor($difference / 12);

        $tmp = ($days * 24) + ($month * 24 * 30);
        $hours+=$tmp;

        //exclude weekends
        $count = 0;
        for($i=0;$i<=$days;$i++):
            $day = date('D',strtotime($start_date));
            if($day=='Sat' || $day=='Sun'){
                $count++;
            }
            $start_date = date('Y-m-d H:i:s', strtotime($start_date . ' +1 day'));
        endfor;

        return $days-$count;
    }
    
    

    
}