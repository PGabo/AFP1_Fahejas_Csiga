<?php

class Account
{
    private $pageIndex = 1;
    private $con;
    private $OrderBy;
    private $Order;
    private $searchInput;
    private $numOfItems = 25;
    public function __construct($con)
    {
        $this->con = $con;
    }
    public function GetSearchInput(){
        return $this->searchInput;
    }
    public function GetOrder(){
        return $this->Order;
    }
    public function GetOrderBy(){
        return $this->OrderBy;
    }
    public function GetNumOfItems(){
        return $this->numOfItems;
    }
    public function GetPageIndex(){
        return $this->pageIndex;
    }
    public function ShowPageNumbers(){
        $query = "SELECT COUNT(*) FROM allatmentok INNER JOIN userregistration ON allatmentok.madeby = userregistration.id WHERE userregistration.status = 1";
        $isSearch = $this->searchInput != null;
        if ($isSearch)
        {
            $query .= " AND (Nev LIKE :search1
            OR Cim LIKE :search2
            OR Megye LIKE :search3
            OR Elerhetoseg LIKE :search4
            OR Ado LIKE :search5
            OR Weblink LIKE :search6) ";
        }
        $sql = $this->con->prepare($query);
        if ($isSearch) {
            $searchInput = "%$this->searchInput%";
            for ($i = 1; $i <= 6; $i++) {
                $sql->bindParam(":search$i", $searchInput, PDO::PARAM_STR);
            }
        }
        $sql->execute();
        $result = $sql->fetchColumn();
        return $result;
    }
    public function SelectRecordsOfTablesByStatus(){
        $query = "SELECT allatmentok.id, Nev, Cim,Megye,Elerhetoseg,Ado,Weblink FROM allatmentok INNER JOIN userregistration ON allatmentok.madeby = userregistration.id WHERE userregistration.status = 1";
        $isSearch = $this->searchInput != null;
        $isOrderBy = in_array($this->OrderBy, array("Nev", "Cim", "Megye")); //valamiért ezt nem sikerült bindparamozni
        $isOrder = $isOrderBy && in_array($this->Order, array("ASC", "DESC"));
        $isPageNumber = $this->pageIndex != null && is_int($this->pageIndex);
        if ($isSearch)
        {
            $query .= " AND (Nev LIKE :search1
            OR Cim LIKE :search2
            OR Megye LIKE :search3
            OR Elerhetoseg LIKE :search4
            OR Ado LIKE :search5
            OR Weblink LIKE :search6) ";
        }
        if ($isOrderBy)
        {
            $query .= " ORDER BY $this->OrderBy ";
        }
        if ($isOrder) {
            $query .= $this->Order;
        }
        $query.=" LIMIT $this->numOfItems";
        if ($isPageNumber)
        {
            $number = ($this->pageIndex-1)*$this->numOfItems;
            $query.=" OFFSET ".$number;
        }
        $sql = $this->con->prepare($query);
        if ($isSearch) {
            $searchInput = "%$this->searchInput%";
            for ($i = 1; $i <= 6; $i++) {
                $sql->bindParam(":search$i", $searchInput, PDO::PARAM_STR);
            }
        }
        $sql->execute();
        $result = $sql->fetchAll(PDO::PARAM_STR);

        return $result;
    }

    public function Search($order, $orderby, $search, $pagenumber){
        $this->OrderBy = $orderby;
        $this->Order = $order;
        $this->searchInput = $search;
        $this->pageIndex = intval($pagenumber);
    }


}