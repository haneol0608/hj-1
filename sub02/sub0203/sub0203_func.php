<?php 
    function lap($conn, $ho, $por, $qt_no, $count) {
        $select_lap_query = "SELECT COUNT(lap) AS count_lap FROM hj_lada WHERE ho = '$ho' AND por = '$por' AND qt_no = '$qt_no' AND paint != '' AND lap !=''";
        $select_lap_result = mysqli_query($conn, $select_lap_query);
        $lap_row = mysqli_fetch_assoc($select_lap_result);
        $count_lap = $lap_row['count_lap'];

        if($count_lap == 0) {
            echo "";
        } else if($count == $count_lap) {
            echo "3P";
        } else if($count > $count_lap) {
            echo "일부 3P";
        }
    }

    function seq($conn, $ho, $por, $qt_no) {
        $seq_arr = array();
        $select_seq_query = "SELECT seq FROM hj_lada WHERE ho = '$ho' AND por = '$por' AND qt_no = '$qt_no' GROUP BY seq ORDER BY seq ASC";
        $select_seq_result = mysqli_query($conn, $select_seq_query);
        while($seq_row = mysqli_fetch_assoc($select_seq_result)) {
            $seq = $seq_row['seq'];
            array_push($seq_arr, $seq);
            echo "<input type='hidden' name='prolist_seq[]' value='$seq'> ";
            $seq = $seq . ", ";
            echo $seq < 10 ? "0" . $seq : $seq;
        }
    }

    function paint($conn, $ho, $por, $qt_no) {
        $select_paint_query = "SELECT paint, COUNT(paint) AS count_paint FROM hj_lada WHERE ho = '$ho' AND por = '$por' AND paint != '' AND qt_no = '$qt_no' GROUP BY ho, por, paint, qt_no ";
        $select_paint_result = mysqli_query($conn, $select_paint_query);
        while($paint_row = mysqli_fetch_assoc($select_paint_result)) {
            $paint = $paint_row['paint'];
            $count_paint = $paint_row['count_paint'];

            echo $paint . " : " . $count_paint . "<br>";
        }
    }

    function revision($conn, $ho, $por) {
        $select_revision_query = "SELECT revision FROM hj_draw WHERE ho = '$ho' AND por = '$por'  ";
        $select_revision_result = mysqli_query($conn, $select_revision_query);
        $revision_row = mysqli_fetch_assoc($select_revision_result);
        $revision = $revision_row['revision'];
        if($revision == null or $revision == "") {
            echo "";
        } else if($revision == 0) {
            echo "0";
        } else if($revision < 10) {
            echo "00" . $revision;
        } else if($revision > 10 AND $revision < 100) {
            echo "0" . $revision;
        }
    }
?>