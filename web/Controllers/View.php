<?php
class Table
{
    private $pageIndex = 1;
    private $numOfItems;
    private $count;
    private $data;
    private $pages;
    public function __construct($data, $numOfItems, $pageIndex)
    {
        $this->data = $data;
        $this->numOfItems = $numOfItems;
        $this->pageIndex = $pageIndex;
        $this->count = sizeof($data);
        $this->pages = intval(ceil($this->count/$this->numOfItems));
    }
    public function GetPageIndex(){
        return $this->pageIndex;
    }
    public function FillTable()
    {
        $isAdmin =  isset($_SESSION['admin']) && $_SESSION['admin'];
        for ($i = 0; $i < $this->count; $i++) {
            $nev = htmlspecialchars($this->data[$i]['Nev']);
            $Cim = htmlspecialchars($this->data[$i]['Cim']);
            $megye = htmlspecialchars($this->data[$i]['Megye']);
            $elerhetoseg = htmlspecialchars($this->data[$i]['Elerhetoseg']);
            $ado = htmlspecialchars($this->data[$i]['Ado']);
            $weblink = htmlspecialchars($this->data[$i]['Weblink']);
            $id = htmlspecialchars($this->data[$i]['id']);
            $address = isProperAddress($this->data[$i]['Cim']) ? htmlspecialchars($this->data[$i]['Cim']) : htmlspecialchars($this->data[$i]['Nev'] . ' ' . $this->data[$i]['Cim']);
            $a = filter_var($weblink, FILTER_VALIDATE_URL) ? "<a target='_blank' class='btn btn-primary' href='$weblink'>Link</a></td>" : $weblink;
                echo "<tr class='table_row'>
                        <td><a class='location' target='_blank' href='https://www.google.hu/maps/search/{$address}/'><i class=\"fas fa-map-marker-alt\"></i></a></td>
                        <td>$nev</td>
                        <td>$Cim</td>
                        <td>$megye</td>
                        <td>$elerhetoseg</td>
                        <td>$ado</td>
                        <td>$a</td>";
                    if ($isAdmin){
                        echo "  <td><a class='btn btn-danger' href='delete.php?id={$id}'>Törlés</a></td>
                            <td>
                               <a target='_blank' href='modify.php?id=$id' class='btn btn-warning'>Szerkesztés</a>
                            </td>";
                    }
                    echo "</tr>";

        }
    }
}
?>