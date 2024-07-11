# BlackboardMoodleConverter
Blackboard-Moodle-Converter

@copyright  Kathrin Braungardt, Ruhr-Universität Bochum
@license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later


Converted are documents, content from text elements, links, YouTube mashups and tests.

All question types are converted except for: Calculated Formula, Quiz Bowl.

In Blackboard:
Control Panel -> Packages and Utilities -> Export/Archive Course -> Export Package



Installation:

Put all files in one directory of the webserver. 

Define variable downloadlink in uploaddir.php

Make directory “uploads”,should be writeable by the webserver.

Make directory “exports” einrichten, should be writeable by the webserver.

Make main directory writeable.

Make directory “moodle_src”, with directories course, sections 
and files gradebook.xml, groups.xml, outcomes.xml, roles.xml, scales.xml
2 section directories: section_1, section_2

Make directory “activities_src” with files grades.xml, inforef.xml, roles.xml


Start file: upload.php

*************************************
File structure in Blackboard and Moodle

Blackboard Export Files Structure

.dat files / res folder
ims.manifest.xml
Folder csfiles/home_dir

Blackboard stores each item or the description in a separate XML file (extension .dat).

Moodle structure

Central XML files: files.xml, questions.xml, moodle_backup.xml
activities folder: contains all activities in folders
sections folder: contains all sections in folders
Folder files: contains all files in folders

