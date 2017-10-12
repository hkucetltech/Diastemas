<?php
/*******************************************************************************
 *
 * lang.php
 *
 * Language file.
 *
 * 20160201 Murphy WONG 		Putting all message here for English.
 *
 ******************************************************************************/
 
/*
------------------
Language: English
------------------
*/
 
GLOBAL $lang;

$lang = array();
 
 // Sitewise
$lang['SITE_TITLE'] = 'U21 Internationalization the Curriculum';
$lang['COPYRIGHT'] = 'Copyright @ 2016 Global Citizenship in Education Portal All Rights Reserved';

// About us
$lang['ABOUT'] = "The Global Citizenship in Eductaion enables our students to blog and build communities, " .
	"with similar features to many social media websites like Facebook and MySpace. Funded by the " . 
	"Universitas 21, the web platform is designed to allow international student collaboration through ". 
	"their participation in peer reviews of each others’ clinical work and group participation in case " .
	"based tutorials in different disciplines. To date the participating universities are: University of " .
	"Hong Kong and Western University of Health Sciences and it is envisioned the project will move into " .
	"many other areas of the world. The main aim of the project is to open up free dialogue between the " . 
	"students to establish a comfortable rapport allowing them to learn and grow from each other. From this " .
	"grass roots approach it is hoped to create a harmonization of dental standards throughout the world due " .
	"to faculty exposure to international dental treatment.  In addition, it is envisioned an understanding " . 
	"in the new practitioner will carry with it many changes as they become the leaders in the natural course " .
	"of events. To date participating students have enjoyed the experience claiming a new found respect for " .
	"procedures that are “different” and a feeling of closeness and belonging to the global dental community. " .
	"With reflections such as these, good things are bound to happen.";
$lang['SITE_LOGO'] = 'Global Citizenship in Education';
$lang['SITE_PORTAL'] = 'Diastemas Portal';
 
// Menu bar
$lang['MENU_ABOUT_US'] = 'About Us';
$lang['MENU_EVENTS'] = 'Upcoming Events';
$lang['MENU_HOME'] = 'Home';
$lang['MENU_NEWS'] = 'News';
$lang['MENU_SEARCH'] = 'Search this site';
$lang['MENU_SIGN_UP'] = 'Sign up';

// Button
$lang['BUTTON_SAVE_CHANGES'] = 'Save changes';
$lang['BUTTON_CANCEL'] = 'Cancel';
$lang['BUTTON_SEARCH'] = 'Search';
$lang['BUTTON_SEND'] = 'Send';
$lang['BUTTON_REPLY'] = 'Reply';

$lang['BUTTON_ADMIN'] = 'Admin';
$lang['BUTTON_EDIT'] = 'Edit';
$lang['BUTTON_DELETE'] = 'Delete';
$lang['BUTTON_SUBMIT'] = 'Submit';
$lang['BUTTON_RESET_PASSWORD'] = 'Reset Pwd';


$lang['CLOSE'] = 'Close';
$lang['BACK'] = 'Back';
$lang['EDIT'] = 'Edit';
$lang['DELETE'] = 'Delete';

// index.php
$lang['ALERT_EMAIL'] = 'Please fill in e-mail address.';
$lang['ALERT_VALID_EMAIL'] = 'Please fill in a valid e-mail address.';
$lang['ALERT_GIVENNAME'] = 'Please fill in your given name.';
$lang['ALERT_SURNAME'] = 'Please fill in your surname.';
$lang['ALERT_SCHOOL'] = 'Please select your school.';
$lang['ALERT_YEAR_GRADUATION'] = 'Please fill in the year you are expected to graduate.';
$lang['ALERT_NOT_FOUND'] = 'Email address is not found.';
$lang['ALERT_SCHOLLADMIN_NOT_FOUND'] = 'School Admin email address is not found.';
$lang['ALERT_SIGNUP_FAILED'] = 'Signup Application Form submission failed.';
$lang['ALERT_SIGNUP_SUCCESS'] = 'Signup Application Form submission success.';
$lang['ALERT_USER_NOT_FOUND'] = 'User not found.';

$lang['ALERT_INPUT_EMAIL'] = 'Please input Email.';
$lang['ALERT_INPUT_PASSWORD'] = 'Empty password. Please input Password.';
$lang['ALERT_PASSWORD_INCORRECT'] = 'Password incorrect.';
$lang['ALERT_CANNOT_LOGIN'] = 'You can not log in.';

$lang['CHOOSE_SCHOOL'] = 'Please choose your school';
$lang['EMAIL'] = 'Email';
$lang['FORGET_PASSWORD'] = 'Forget password? (for student only)';
$lang['PASSWORD'] = 'Password';
$lang['RESET_PASSWORD'] = 'Reset password for student';
$lang['ROLE'] = 'Role';
$lang['SCHOOL'] = 'School';
$lang['SCHOOL_ADMIN'] = 'School Admin';
$lang['SIGN_UP'] = 'Sign up';
$lang['STUDENT'] = 'Student';
$lang['SUPER_ADMIN'] = 'Super Admin';
$lang['VALID_EMAIL'] = 'A valid e-mail address';

$lang['HI'] = 'Hi';
$lang['FIRSTNAME'] = 'First name';
$lang['LASTNAME'] = 'Last name';
$lang['GIVENNAME'] = 'Your given name';
$lang['SURNAME'] = 'Your surname';
$lang['USERNAME'] = 'User name';
$lang['USER_IMAGE'] = 'User image';
$lang['USER_BACKGROUND'] = 'User background';
$lang['GRADUATION_YEAR'] = 'Graduation Year';
$lang['EXPECTED_GRADUATION_YEAR'] = 'Please fill in the year you are expected to graduate';

$lang['DEAR'] = 'Dear';
$lang['MSG_REGISTRATION'] = '<br><br>Thank you for registering at the Diastemas Portal. ' .
	'You may now login to http://' . $_SERVER['SERVER_NAME'] . ' using the following username and password.';
$lang['MSG_USERNAME'] = '<br><br>Your username : ';
$lang['MSG_PASSWORD'] = '<br> Your password : ';
$lang['MSG_CHANGE_PASSWORD'] = '<br>You may log in and change your password at http://' . $_SERVER['SERVER_NAME'];
$lang['MSG_ELEARNING_TEAM'] = '<br><br>e-Learning Team, Faculty of Education, HKU';
$lang['YOUR_PASSWORD'] = 'Your password has been reset to: ';
$lang['DIASTEMAS_RESET_PASSWORD'] = 'Diastemas Reset Password';
$lang['RESET_PASSWORD_FAILED'] = 'Reset password failed.';
$lang['RESET_PASSWORD_SUCCEED'] = 'Reset password succeed.';
$lang['PASSWORD_SENT_FAILED'] = 'Password email cannot deliver...';
$lang['PASSWORD_SENT_SUCCEED'] = 'Password email sent.';
$lang['DIASTEMAS_REGISTRATION'] = 'Diastemas Registration';

// profile.php
$lang['MENU_MY_PROFILE'] = 'My profile';
$lang['MENU_MEMBER_PROFILE'] = 'Member profile';
$lang['MENU_MY_WALL'] = 'My wall';
$lang['MENU_SCHOOL'] = 'School';
$lang['MENU_MY_SCHOOL'] = 'My school';
$lang['MENU_PROJECT'] = 'Project';
$lang['MENU_MY_PROJECT'] = 'My project';
$lang['MENU_MY_STUDENTS'] = 'My students';
$lang['MENU_COMMUNITY'] = 'Community';
$lang['MENU_MY_COMMUNITY'] = 'My community';
$lang['MENU_RESOURCES'] = 'Specific resources';
$lang['MENU_STATISTICS'] = 'Statistics';
$lang['MENU_TRACKING_REPORT'] = 'Student tracking reports';
$lang['MENU_CHARTS'] = 'Charts';
$lang['MENU_GROUPING'] = 'Grouping';
$lang['MENU_NEWS'] = 'News';
$lang['MENU_EVENTS'] = 'Upcoming Events';
$lang['MENU_LOUNGE'] = 'Global lounge';

$lang['ALERT_INPUT_USERNAME'] = 'Please input User Name.';
$lang['ALERT_PASSWORD'] = 'Password must be 4-16 digits without space and symbols.';
$lang['ALERT_REENTER_PASSWORD'] = 'Please re-enter your Password.';
$lang['ALERT_PASSWORD_MISMATCH'] = 'Password mismatch, please re-enter your Password.';
$lang['ALERT_PHOTO_TOO_LARGE'] = 'Photo can not be larger than 10MB.';
$lang['ALERT_PHOTO_FORMAT'] = 'Photo must be: jpg/jpeg/gif/png.';
$lang['ALERT_BACKGROUND_TOO_LARGE'] = 'Background can not be larger than 10MB.';
$lang['ALERT_BACKGROUND_FORMAT'] = 'Background must be: jpg/jpeg/gif/png.';

$lang['ASSIGNMENT_MANAGER'] = 'Assignment manager';
$lang['PROFILE_SETTINGS'] = 'Profile settings';
$lang['PROFILE_DETAILS'] = 'Profile details';
$lang['CHANGE_PROFILE_SUCCESS'] = 'Change profiles success.';
$lang['LOGOUT'] = 'Logout';
$lang['WELCOME_BACK'] = 'Welcome back! Your last visit: ';

$lang['STUDENTS_LIST'] = 'Students list';
$lang['MEMBERS_LIST'] = 'Community members list';

$lang['IDENTITY'] = 'Identity';
$lang['SUPER_ADMIN'] = 'Super Admin';
$lang['UNIVERSITY'] = 'University';
$lang['INTRODUCTION'] = 'Introduction';
$lang['CONTACT_TEL'] = 'Contact Tel';
$lang['GENDER'] = 'Gender';
$lang['MALE'] = 'Male';
$lang['FEMALE'] = 'Female';
$lang['WHY_INTERESTED'] = 'Why you are interested in this project';
$lang['WHAT_CASE'] = 'What <i>Ideal School</i> you will be presenting';
$lang['RECENT_ACTIVITY'] = 'Recent Activity';
$lang['COMMENTED_ON'] = 'commented on';
$lang['LOADING'] = 'Loading...';
$lang['UPLOADED'] = 'uploaded';
$lang['FILE'] = 'file';
$lang['CHANGE_PASSWORD'] = 'Change password';
$lang['CONFIRM_PASSWORD'] = 'Confirm password';
$lang['LEAVE_EMPTY'] = 'if not modify, please leave empty';

// school.php
$lang['SCHOOL_LOGO'] = 'Logo';
$lang['SCHOOL_NAME'] = 'School name';
$lang['SCHOOL_EMAIL'] = 'School Email';
$lang['SCHOOL_TEL'] = 'School Tel';
$lang['SCHOOL_IMAGE'] = 'School image (200 x 200)';
$lang['SCHOOL_BACKGROUND'] = 'School introduction and background';
$lang['SCHOOL_FACULTY'] = 'Faculty name';
$lang['SCHOOL_FACULTY_URL'] = 'Faculty URL';
$lang['SCHOOL_FACULTY_BACKGROUND'] = 'Faculty introduction and background';
$lang['ADD_SCHOOL_SUCCESS'] = 'Add School success.';
$lang['CHANGE_SCHOOL_SUCCESS'] = 'Change School details success.';
$lang['DELETE_SCHOOL_SUCCESS'] = 'Delete School success.';
$lang['SELECT_MEMBER'] = 'Select university member(s)';
$lang['MEMBERS'] = 'Member(s)';
$lang['SCHOOL_LIST'] = 'School List';
$lang['STUDENT'] = 'Student';
$lang['EDIT_SCHOOL'] = 'Edit School';
$lang['ADD_SCHOOL'] = 'Add School';
$lang['SCHOOL_ADMIN_LIST'] = 'School Admin List';
$lang['UPDATE_SORT'] = 'Update Sort';
$lang['RECEIVE_EMAIL'] = 'receive email';
$lang['SET_RECEIVE_EMAIL'] = 'Set Receive Email';

$lang['NO_RIGHT'] = 'No access rights to proceed.';
$lang['CHOOSE_OPTION'] = 'Choose an option...';
$lang['ALERT_INPUT_SCHOOLNAME'] = 'Please input School Name.';
$lang['ALERT_SCHOOL_REGISTERED'] = 'The School has been registered.';
$lang['ALERT_EMAIL_REGISTERED'] = 'The Email has been registered, please choose another one.';

$lang['EDIT_SCHOOL_ADMIN'] = 'Edit School Admin';
$lang['ADD_SCHOOL_ADMIN'] = 'Add School Admin';
$lang['ADMIN_NAME'] = 'Admin Name';
$lang['ADMIN_EMAIL'] = 'Admin Email';
$lang['ADMIN_IMAGE'] = 'Admin Image';
$lang['ADMIN_INTRO'] = 'Admin Introduction';

// students.php
$lang['ADD_STUDENT'] = 'Add Student';
$lang['EDIT_STUDENT'] = 'Edit Student';
$lang['STUDENT_LIST'] = 'Students List';
$lang['STUDENT_NAME'] = 'Student Name';
$lang['STUDENT_EMAIL'] = 'Student Email';
$lang['STUDENT_IMAGE'] = 'Student Image';
$lang['STUDENT_INTRO'] = 'Student Introduction';
$lang['STUDENT_NAME'] = 'Student Name';
$lang['STUDENT_NAME'] = 'Student Name';


// community.php
$lang['COMMUNITY'] = 'Community';
$lang['NO_COMMUNITY'] = 'No community assigned';
$lang['YOUR_MESSAGE'] = 'your message...';
$lang['YOUR_LINK'] = 'your link...';
$lang['ATTACH_FILE'] = 'Attach a file';
$lang['ATTACH_LINK'] = 'Attach a link';
$lang['GALLERY_THUMBNAIL'] = 'gallery thumbnail';
$lang['COMMENT'] = 'Comment';
$lang['LIKE'] = 'Like';
$lang['UNLIKE'] = 'Unlike';
$lang['ACTIVITY_BY_POST'] = 'Activity by post';
$lang['POSTS_REPLIES'] = 'posts/replies';
$lang['POSTS'] = 'posts';
$lang['NETWORK_DIAGRAM'] = 'Network diagram';
$lang['NO_LOGIN_ERROR'] = 'Error: nologin';
$lang['NO_ID_ERROR'] = 'Error: noid';

$lang['COMMUNITY_LIST'] = 'Community List';
$lang['MEMBER_LIST'] = 'Member List';
$lang['ADD_MEMBER'] = 'Add Member';
$lang['MEMBER'] = 'Member';
$lang['NO_MEMBER'] = 'No member';
$lang['COMMUNITY_PIE_NO_READY'] = 'No message posted, pie chart not generated';
$lang['COMMUNITY_REGISTERED'] = 'The Community has been registered, please choose another one.';
$lang['CONFIRM_DELETE_COMMUNITY'] = 'Are you sure to delete this community?';

$lang['ALERT_FILE_TOO_LARGE'] = 'Uploaded file can not be larger than 10MB.';
$lang['ALERT_FILE_FORMAT'] = 'File format must be: jpg/jpeg/gif/png/doc/xls/ppt/pdf/zip/rar.';
$lang['UPDATE_COMMUNITY_SUCCESS'] = 'Community message posted.';
$lang['DELETE_SELECTED_MEMBERS'] = 'Delete selected members';
$lang['ADD_SELECTED_MEMBERS'] = 'Add selected members';
$lang['EDIT_COMMUNITY'] = 'Edit community';
$lang['ADD_COMMUNITY'] = 'Add community';
$lang['COMMUNITY_NO'] = 'Community No';
$lang['COMMUNITY_INTRO'] = 'Community introduction';


// project.php
$lang['PROJECT'] = 'Project';
$lang['PROJECT_LIST'] = 'Project List';
$lang['EDIT_PROJECT'] = 'Edit Project';
$lang['ADD_PROJECT'] = 'Add Project';
$lang['PROJECT_NAME'] = 'Project name';
$lang['PROJECT_DETAILS'] = 'Project details';
$lang['COMMUNITY_FOUND'] = 'Community(Communities) found under project, ' . 
	'please remove communities before deleteing a project!';
$lang['PROJECT_FOUND'] = 'The Project has been registered, please choose another one.';
$lang['ADD_PROJECT_SUCCESS'] = 'Add project success.';
$lang['CHANGE_PROJECT_SUCCESS'] = 'Change project details success.';
$lang['DELETE_PROJECT_SUCCESS'] = 'Delete project success.';
$lang['SELECT_UNIVERSITY_MEMBER'] = 'Select university member(s)';


// news.php
$lang['NEWS_LIST'] = 'News List';
$lang['EDIT_NEWS'] = 'Edit News';
$lang['ADD_NEWS'] = 'Add News';
$lang['NEWS_TITLE'] = 'News Title';
$lang['NEWS_DATE'] = 'News Date';
$lang['NEWS_CONTENT'] = 'News Content';
$lang['ADD_NEWS_SUCCESS'] = 'Add news success.';
$lang['CHANGE_NEWS_SUCCESS'] = 'Change news success.';
$lang['DELETE_NEWS_SUCCESS'] = 'Delete news success.';


// events.php
$lang['EVENTS_LIST'] = 'Events List';
$lang['EDIT_EVENTS'] = 'Edit Events';
$lang['ADD_EVENTS'] = 'Add Events';
$lang['EVENTS_TITLE'] = 'Events Title';
$lang['EVENTS_DATE'] = 'Events Date';
$lang['EVENTS_TIME'] = 'Events Time';
$lang['EVENTS_CONTENT'] = 'Events Content';
$lang['ADD_EVENTS_SUCCESS'] = 'Add events success.';
$lang['CHANGE_EVENTS_SUCCESS'] = 'Change events success.';
$lang['DELETE_EVENTS_SUCCESS'] = 'Delete events success.';


// lounge.php
$lang['GLOBAL_LOUNGE'] = 'Global lounge';
$lang['THERE_ARE'] = 'There are ';
$lang['UNIVERSITIES'] = ' universities';
$lang['ENVISIONED'] = ' and it is envisioned the project will move into many other areas of the world.';
$lang['SCHOOL_DETAILS'] = ' School details';
$lang['BUTTON_PREVIOUS'] = 'Previous';
$lang['BUTTON_NEXT'] = 'Next';

// system messages
$lang['GD_NO_GIF'] = 'GD library cannot use GIF format images, please use Jpeg or PNG format.';
$lang['GD_NO_JPG'] = 'GD library cannot use JPG format images, please use GIF or PNG format.';
$lang['GD_NO_GIF_JPG'] = 'You cannot upload jpg or gif picture!';

?>
