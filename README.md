# BlackboardMoodleConverter
Blackboard-Moodle-Converter

@copyright  Kathrin Braungardt, Ruhr-Universität Bochum
@license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later


Converted are documents, content from text elements, links, YouTube mashups and tests.

All question types are converted except for: Calculated Formula, Quiz Bowl.

In Blackboard:
Control Panel -> Packages and Utilities -> Export/Archive Course -> Export Package

Installation:

Put all files in one directory of the server. This version converts files one by one.

Make directory “uploads”.

Make directory “exports”.

Make directory “activities_src” with files grades.xml, inforef.xml, roles.xml

Make directory “moodle_src” einrichten, with directories course, sections 
and files gradebook.xml, groups.xml, outcomes.xml, roles.xml, scales.xml
2 section directories: section_1, section_2


Start file for terminal version: php parse.php
