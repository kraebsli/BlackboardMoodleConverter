# BlackboardMoodleConverter
Blackboard-Moodle-Converter

@copyright  Kathrin Braungardt, Ruhr-Universität Bochum
@license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later


Converted are documents, content from text elements, links, YouTube mashups and tests.

All question types are converted except for: Calculated Formula, Quiz Bowl.

In Blackboard:
Control Panel -> Packages and Utilities -> Export/Archive Course -> Export Package

Installation:

Put all files in one directory of the webserver. This directory should be writeable by the webserver.

Define variables uploaddir und downloadlink in uploaddir.php. Not necessary in terminal version.

Make directory “uploads”,should be writeable by the webserver.

Make directory “exports” einrichten, should be writeable by the webserver.

Make directory “activities_src” with files grades.xml, inforef.xml, roles.xml


Make directory “moodle_src” einrichten, with directories course, sections 
and files gradebook.xml, groups.xml, outcomes.xml, roles.xml, scales.xml
2 section directories: section_1, section_2


start file for web version: upload.php

start file for terminal version: parse.php
