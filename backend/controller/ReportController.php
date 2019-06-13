<?php
class ReportController
{
    private $conn;

    public function __construct()
    {
        $this->conn = DbConnection::getDbConnection();
    }

    public function htmlReport($userEmail, $stock, $note, $occasion, $season, $date1, $date2, $limit)
    {
        $sqlQuery = 'begin :message := raport_html(:p_email, :p_stoc, :p_nota, :p_ocazie, :p_sezon,
            :p_data1, :p_data2, :p_limita); end;';

        $result = '';

        if (!($stmt = oci_parse($this->conn, $sqlQuery)))
        {
            http_response_code(500);
            echo "Filtering failed";
        } else
        {
            oci_bind_by_name($stmt, ':p_email', $userEmail);
            oci_bind_by_name($stmt, ':p_stoc', $stock);
            oci_bind_by_name($stmt, ':p_nota', $note);
            oci_bind_by_name($stmt, ':p_ocazie', $occasion);
            oci_bind_by_name($stmt, ':p_sezon', $season);
            oci_bind_by_name($stmt, ':p_data1', $date1);
            oci_bind_by_name($stmt, ':p_data2', $date2);
            oci_bind_by_name($stmt, ':p_limita', $limit);
            oci_bind_by_name($stmt, ':message', $result, 400, SQLT_CHR);

            oci_execute($stmt);
            oci_commit($this->conn);
        }

        if($result != 'Succes!')
        {
            return false;
        }


        return true;
    }

    public function csvReport($userEmail, $stock, $note, $occasion, $season, $date1, $date2, $limit)
    {
        $sqlQuery = 'begin :message := raport_csv(:p_email, :p_stoc, :p_nota, :p_ocazie, :p_sezon,
            :p_data1, :p_data2, :p_limita); end;';

        $result = '';

        if (!($stmt = oci_parse($this->conn, $sqlQuery)))
        {
            http_response_code(500);
            echo "Filtering failed";
        } else
        {
            oci_bind_by_name($stmt, ':p_email', $userEmail);
            oci_bind_by_name($stmt, ':p_stoc', $stock);
            oci_bind_by_name($stmt, ':p_nota', $note);
            oci_bind_by_name($stmt, ':p_ocazie', $occasion);
            oci_bind_by_name($stmt, ':p_sezon', $season);
            oci_bind_by_name($stmt, ':p_data1', $date1);
            oci_bind_by_name($stmt, ':p_data2', $date2);
            oci_bind_by_name($stmt, ':p_limita', $limit);
            oci_bind_by_name($stmt, ':message', $result, 400, SQLT_CHR);

            oci_execute($stmt);
            oci_commit($this->conn);
        }

        if($result != 'Succes!')
        {
            return false;
        }


        return true;
    }

    public function pdfReport($userEmail, $stock, $note, $occasion, $season, $date1, $date2, $limit)
    {
        $sqlQuery = 'begin :message := raport_pdf(:p_email, :p_stoc, :p_nota, :p_ocazie, :p_sezon,
            :p_data1, :p_data2, :p_limita); end;';

        $result = '';

        if (!($stmt = oci_parse($this->conn, $sqlQuery)))
        {
            http_response_code(500);
            echo "Filtering failed";
        } else
        {
            oci_bind_by_name($stmt, ':p_email', $userEmail);
            oci_bind_by_name($stmt, ':p_stoc', $stock);
            oci_bind_by_name($stmt, ':p_nota', $note);
            oci_bind_by_name($stmt, ':p_ocazie', $occasion);
            oci_bind_by_name($stmt, ':p_sezon', $season);
            oci_bind_by_name($stmt, ':p_data1', $date1);
            oci_bind_by_name($stmt, ':p_data2', $date2);
            oci_bind_by_name($stmt, ':p_limita', $limit);
            oci_bind_by_name($stmt, ':message', $result, 400, SQLT_CHR);

            oci_execute($stmt);
            oci_commit($this->conn);
        }

        if($result != 'Succes!')
        {
            return false;
        }


        return true;
    }
}