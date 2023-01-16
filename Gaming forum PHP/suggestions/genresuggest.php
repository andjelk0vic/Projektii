<?php

    // Genres

    $genres[] = "Action";
    $genres[] = "Adventure";
    $genres[] = "Strategy";
    $genres[] = "Sport";
    $genres[] = "RPG";
    $genres[] = "Platform";
    $genres[] = "Racing";
    $genres[] = "Puzzle";

    // Get query string

    $q = $_REQUEST['q'];
    $suggestion = "";

    // Get suggestions

    if($q !== "") {
        $q = strtolower($q);
        $len = strlen($q);
        foreach($genres as $genre) {
            if(stristr($q, substr($genre, 0, $len))) {
                if($suggestion === "") {
                    $suggestion = $genre;
                } else {
                    $suggestion .= ", $genre";
                }
            }
        }
    }
    echo $suggestion === "" ? "No suggestions" : $suggestion;
?>