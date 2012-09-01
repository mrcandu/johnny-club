<?php
class Table {
    protected $opentable = "\n<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">\n";
    protected $closetable = "</table>\n";
    protected $openrow = "\t<tr>\n";
    protected $closerow = "\t</tr>\n";

    function __construct($data) {
        $this->string = $this->opentable;
        foreach ($data as $row) {
            $this->string .= $this->buildrow($row);
        }
        $this->string .= $this->closetable;
    }

    function addfield($field, $style = "null") {
        if ($style == "null") {
            $html =  "\t\t<td>" . $field . "</td>\n";
        } else {
            $html = "\t\t<td class=\"" . $style . "\">"  . $field . "</td>\n";
        }
        return $html;
    }

    function buildrow($row) {
        $html .= $this->openrow;
        foreach ($row as $field) {
            $html .= $this->addfield($field);
        }
        $html .= $this->closerow;
        return $html;
    }

    function draw() {
        return $this->string;
    }
}
?>