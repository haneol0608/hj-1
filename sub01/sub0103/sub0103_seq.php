<?php 
    function seq($conn, $ho, $por, $qt_no) {
        $seq_arr = array();
        $select_seq_query = "SELECT seq FROM hj_prolist WHERE ho = '$ho' AND por = '$por' AND qt_no = '$qt_no' GROUP BY seq ORDER BY seq ASC";
        $select_seq_result = mysqli_query($conn, $select_seq_query);
        while($seq_row = mysqli_fetch_assoc($select_seq_result)) {
            $seq = $seq_row['seq'];
            array_push($seq_arr, $seq);
            echo "<input type='hidden' name='prolist_seq[]' value='$seq'> ";
            $seq = $seq . ", ";
            echo $seq < 10 ? "0" . $seq : $seq;
        }
    }
?>