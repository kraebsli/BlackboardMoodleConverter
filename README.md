# BlackboardMoodleConverter
Blackboard-Moodle-Converter

@copyright  Kathrin Braungardt, Ruhr-Universität Bochum
@license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later


Converted are documents, content from text elements, links, YouTube mashups and tests.

All question types are converted except for: Calculated Formula, Quiz Bowl.

In Blackboard:
Control Panel -> Packages and Utilities -> Export/Archive Course -> Export Package



Installation:

Put all files in one directory of the server. You can convert multiple files one after the other automatically. 

Make directory “uploads”. In uploads you copy the Blackboard zip files.
Make directory “unzip” inside uploads. In the directory "unzip" are extracted the Blackboard zip files.

Make directory “exports” .

Make directory logs_notok. If there are errors they get written to this directory.

Make directory “activities_src” with files grades.xml, inforef.xml, roles.xml

Make directory “moodle_src” einrichten, with directories course, sections 
and files gradebook.xml, groups.xml, outcomes.xml, roles.xml, scales.xml
2 section directories: section_1, section_2


start file: sh batch.sh
