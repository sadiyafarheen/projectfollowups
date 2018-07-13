-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 13, 2018 at 08:07 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afitek_psb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `hide` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `name`, `hide`) VALUES
(20, 28, 'Follow ups with team', 0),
(21, 28, 'UAT Feedback', 0),
(23, 28, 'Personal things to Rbr', 0),
(24, 30, 'Phase 2', 0),
(27, 33, 'Category', 0),
(29, 28, 'School Events', 0),
(30, 35, 'To-Do List', 0),
(31, 30, 'Mandel', 0),
(32, 28, 'test 2 delete', 0),
(33, 30, 'Stories', 0),
(34, 28, 'Last Dev Phase', 0),
(36, 39, 'corrections', 0),
(37, 30, 'cross functional impacts', 0),
(38, 28, 'Product ideas', 0),
(39, 30, 'Test cases', 0),
(40, 28, 'Family Events', 0),
(41, 30, 'Daily Sync', 0),
(42, 30, 'Team Mtg', 0),
(43, 30, 'Reference Items', 0),
(44, 52, 'Test Topic', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_updates`
--

CREATE TABLE `category_updates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `update_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_updates`
--

INSERT INTO `category_updates` (`id`, `user_id`, `category_id`, `update_id`) VALUES
(87, 28, 40, 114),
(2, 28, 20, 3),
(3, 28, 20, 4),
(96, 30, 33, 123),
(6, 28, 20, 7),
(77, 28, 29, 104),
(8, 28, 21, 9),
(9, 28, 20, 16),
(45, 30, 37, 68),
(11, 28, 21, 27),
(78, 28, 29, 105),
(13, 28, 20, 29),
(14, 28, 28, 30),
(15, 28, 28, 31),
(16, 28, 28, 32),
(79, 28, 23, 106),
(80, 28, 20, 107),
(19, 28, 28, 35),
(20, 28, 28, 36),
(21, 28, 28, 37),
(22, 28, 28, 38),
(23, 28, 28, 39),
(24, 28, 28, 40),
(25, 28, 28, 41),
(26, 28, 28, 42),
(93, 30, 33, 120),
(28, 28, 20, 44),
(29, 28, 23, 46),
(59, 30, 33, 84),
(31, 28, 34, 51),
(32, 28, 34, 52),
(43, 33, 27, 66),
(42, 33, 27, 62),
(44, 33, 27, 67),
(84, 30, 37, 111),
(47, 30, 33, 70),
(83, 30, 33, 110),
(49, 30, 33, 72),
(50, 30, 33, 73),
(89, 30, 33, 116),
(52, 30, 33, 75),
(56, 30, 33, 79),
(92, 30, 33, 119),
(55, 28, 23, 78),
(97, 30, 41, 126),
(95, 30, 33, 122),
(86, 30, 33, 113),
(61, 30, 33, 86),
(91, 30, 33, 118),
(63, 30, 33, 88),
(65, 30, 33, 92),
(88, 30, 33, 115),
(67, 28, 40, 94),
(68, 28, 40, 95),
(73, 30, 41, 100),
(75, 30, 41, 102),
(76, 30, 41, 103),
(98, 30, 41, 127),
(99, 30, 41, 128),
(100, 30, 41, 129),
(101, 30, 41, 130),
(102, 30, 41, 131),
(103, 30, 41, 132),
(113, 30, 41, 142),
(105, 30, 41, 134),
(114, 30, 41, 143),
(115, 30, 41, 144),
(116, 30, 41, 145),
(117, 30, 41, 146),
(110, 30, 41, 139),
(118, 30, 41, 147),
(119, 30, 41, 148),
(120, 30, 41, 149),
(121, 30, 41, 150),
(122, 30, 41, 151),
(123, 30, 41, 152),
(124, 30, 41, 153);

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `field_label` varchar(255) NOT NULL,
  `field_value` text NOT NULL,
  `checkbox` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `dashboard` tinyint(1) NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discussions`
--

CREATE TABLE `discussions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1521098704),
('m140209_132017_init', 1521098720),
('m140403_174025_create_account_table', 1521098722),
('m140504_113157_update_tables', 1521098728),
('m140504_130429_create_token_table', 1521098731),
('m140830_171933_fix_ip_field', 1521098734),
('m140830_172703_change_account_table_name', 1521098734),
('m141222_110026_update_ip_field', 1521098736),
('m141222_135246_alter_username_length', 1521098737),
('m150614_103145_update_social_account_table', 1521098741),
('m150623_212711_fix_username_notnull', 1521098741),
('m151218_234654_add_timezone_to_profile', 1521098742),
('m160929_103127_add_last_login_at_to_user_table', 1521098742);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `category_id`, `text`) VALUES
(3, 30, 31, '<p>Why are you meeting with me</p>\n<p>what do you want me to do&nbsp;</p>\n<p>how can I be sure this is a good idea&nbsp;</p>\n<p>&nbsp;</p>\n<p>trs</p>'),
(4, 28, 20, '<div class="gmail_quote">\n<ul>\n<li>If user clicks on Stand-Alone Notes, default display should be Full screen mode <strong>(Done)</strong></li>\n<li>In Full screen mode (CTRL-SHIFT-F) the apps top menu is hidden under the Header menu -plz adjust it&nbsp;<strong>(Done)</strong>\n<ul>\n<li><em><strong>WHile loading notes, for a moment you still see the project page. If no other solution, we must to remove the Focus List, Due Today tabs etc and the category Topic name form the the first notes page</strong></em></li>\n</ul>\n</li>\n<li>Under the Top Topic menu - Add the link for "Stand-Alone Notes" below the "Action Items" menu but change the label to just "Notes". The Notes page should open in full screen mode.&nbsp;<strong>(Done)</strong></li>\n<li>Also Add "Share this Topic" link under the Topic drop down (Same functionality as Share Projects).</li>\n<li>&nbsp;</li>\n<li>Also add Calendar link (calendar should display Action Item details on Due date)&nbsp;<strong>(Done)</strong></li>\n<li>New email: if email addresses seperated by commas is entered in the Assigned To send an email to him if Action Item is added or edited</li>\n<li>Send email to user and Assigned To email addresses 4 days before due date&nbsp;&nbsp;<strong>NOT DONE</strong></li>\n<li>Fix the date format in the email messagge to DD?MM/YYYY also the hyperlink to the category in the email message does not work&nbsp;<strong>(Done)</strong></li>\n<li>Auto save anything entered in Stand Alone notes every 2 minutes&nbsp;<strong>(Done)</strong></li>\n<li>after users clicks on their email from registration link, user is taken to this page.. However,&nbsp;&nbsp;<strong>(Done)</strong></li>\n</ul>\n<div dir="ltr">\n<div><a href="../user/confirm/30/GODAbCipGPXiIUtX06J0KBiZMckW4Qw0" target="_blank" rel="noopener" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://projectfollowups.dev/user/confirm/30/GODAbCipGPXiIUtX06J0KBiZMckW4Qw0&amp;source=gmail&amp;ust=1524471675495000&amp;usg=AFQjCNHHE9SD_8UyG2JNcC68q-c3BDdzrg">http://projectfollowups.dev/us<wbr />er/confirm/30/GODAbCipGPXiIUtX<wbr />06J0KBiZMckW4Qw0</a></div>\n<div>&nbsp;</div>\n<div>It just says Thank you, your registration is complete but&nbsp; Can youredirect them to the homepage?</div>\n<div>\n<ul>\n<li>Create a meeting notes template&nbsp;<strong>(In the next Phase)</strong><br /><br /></li>\n</ul>\n</div>\n</div>\n</div>\n<p>I can pay $125 for these if you can do them in next 4 days. Let me know.&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<ul>\n<li>If user clicks on Stand-Alone Notes, default display should be Full screen mode</li>\n<li>In Full screen mode (CTRL-SHIFT-F) the apps top menu is hidden under the Header menu -plz adjust it</li>\n<li>Under the Top Topic menu - Add the link for "Stand-Alone Notes" below the "Action Items" menu but change the label to just "Notes"</li>\n<li>Also Add "Share this Topic" link under the Topic drop down (Same functionality as Share Projects). Also add Calendar link (calendar should display Action Item details on Due date)</li>\n<li>if email addresses is entered in the Assigned To send an email to him if Action Item is added or edited</li>\n<li>Send email to user and Assigned To email addresses 4 days before due date</li>\n<li>Auto save anything entered in Stand Alone notes every 2 minutes</li>\n</ul>\n<blockquote>\n<div>&nbsp;</div>\n<div>&nbsp;</div>\n<div><br />- Send emails at half way b/w half way to due date. And also send email to email address entered in the assigned to<br />- Follow ups from the project should be just a small bubble&nbsp;<br />- Add another icon to view/edit previous follow ups&nbsp;<br />- Create a meeting notes template&nbsp;<br />- Ability to add attachments&nbsp;</div>\n<div>- Ability to do audio recording for action item<br />- You push a button to start/stop a recording<br />- Action item drop down templates&nbsp;</div>\n</blockquote>'),
(5, 28, 32, '<p>qwerrewter</p>'),
(6, 30, 33, '<p><a href="https://surf.service-now.com/rm_story_list.do?sysparm_query=project%3D2bce2dc8db8d5b0012c0f5771d961909" target="_blank" rel="noopener">link to phase 2 stories</a></p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<table style="border-collapse: collapse; width: 100%;" border="1">\n<tbody>\n<tr>\n<td style="width: 5.97321%;">&nbsp;</td>\n<td style="width: 27.3602%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n</tr>\n<tr>\n<td style="width: 5.97321%;">&nbsp;</td>\n<td style="width: 27.3602%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n</tr>\n<tr>\n<td style="width: 5.97321%;">&nbsp;</td>\n<td style="width: 27.3602%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n</tr>\n<tr>\n<td style="width: 5.97321%;">&nbsp;</td>\n<td style="width: 27.3602%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n</tr>\n<tr>\n<td style="width: 5.97321%;">&nbsp;</td>\n<td style="width: 27.3602%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n<td style="width: 16.6667%;">&nbsp;</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>SP Mtg</p>\n<ul>\n<li>Scope HR Profile to WD -Work Email/Work phone&nbsp; -\n<ul>\n<li>Add work phone to WD Sync for all workers and countries\n<ul>\n<li>international phone format requirements<br />AD--&gt;SP--&gt;updates sysuser work phone&nbsp;</li>\n<li><strong>Create Task for impact and data analysis Asisgn to IAM Opps (Deepali)&nbsp;</strong></li>\n<li>&nbsp;</li>\n</ul>\n</li>\n</ul>\n</li>\n<li>Worker WD to Surf Integration&nbsp;<br />Run Schedule: Changes from current schedule to possibly Sunday<br />( 6 AM , 12 PM, 6 PM, 12 AM M-Thursday, Friday does not have 6 PM and Saturday 12 midnight) <br />add Sunday to schedule (TBD) &lt;add a story for SP&gt;</li>\n<li>SP runs on Sundays already @4 and @10 every day of the week..&nbsp; (Story w Gireesh..check on timing)&nbsp;</li>\n<li>therefore WD--&gt;SURF Should run at&nbsp;</li>\n<li>Task for SP analysis on timings&nbsp;</li>\n<li>sysuser updates Scoped HR Profile? via BR set to Active =False ?(Currently Legacy profile is set to false )</li>\n<li>&nbsp;</li>\n</ul>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<ul>\n<li>New Hire rescind Actions\n<ul>\n<li>ESRQ? --&gt;Cancel ESRQ as well as any related tasks?</li>\n<li>Create Rescind Offboard Request mirrored after the "Offboard request " workflow but triggered from SURF rather than manager. <br />Remove user from any DL</li>\n<li>SP Actions (remove from story if current process)\n<ul>\n<li>SP updates Active Flag to false on sysuser/employee. Anything assigned by SP shall be removed via SP upon rescind.?</li>\n<li>Disable? - SP (WD account removed, if rehire create account) /</li>\n<li>AD Accounts?--&gt;OKTA</li>\n<li>HI Account disabled by SP<br /><br />LDAP/Cloud applications</li>\n<li>AWS</li>\n<li>&nbsp;</li>\n</ul>\n</li>\n</ul>\n</li>\n<li>\n<table width="672">\n<tbody>\n<tr>\n<td colspan="6" width="672">Attributes maintained by SURF (BR Rule or integration user) versus SP (DRAFT)</td>\n</tr>\n</tbody>\n</table>\n</li>\n</ul>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>Ad hoc run UI</p>\n<p>failure UI and Alias</p>\n<p>&nbsp;</p>\n<p>Scoped HR Profile for UI new fields - leave/bonus/Onb section</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>Timezone in emp tbl is not populated from loc/we should update into empl&nbsp;</p>\n<p>&nbsp;</p>\n<p>worker\'s loc - make sure connector is sending the l-code</p>\n<p>&nbsp;</p>\n<p>Conversions<br />Active flag confirm<br />ESQR &ndash; if analysis is complete<br />Prep a list of cross functional changes and communication plan<br />Effected apps<br />Is Offboard Type being used/needed?</p>\n<p>need ACL rules<br /><br />&bull; LMS/SABA <br />o Include Worker Leave Status in Surf<br />Exact value expected? Yes/No<br />Leave Status added to Scoped HR and LMS shall pick it up based on their Update BR</p>\n<p>phone validations for Scoped to WD story</p>\n<p>SP updates Active Flag to false on sysuser and HR Profile (As current process but transition to Scoped HR). <br />Will SURF need to send a request to okta to disable account for rescinds?<br />Which app will Disable? - SP/OKTA/AD Accounts?</p>\n<p>&nbsp;</p>\n<p><br />add the TAB: Country Specific Format : Please check TAB "Tax Withholding" and Phone tab</p>\n<p>check what are existing region and company values for empl tbl currently</p>\n<p>Legal first name - is it being used?</p>\n<p>&nbsp;</p>\n<p>add story for CW--&gt;intern--&gt;FTE</p>\n<p>add story for creating LE Case via script directly by HR Admin</p>\n<p>&nbsp;</p>\n<p>Offboard type - check w offbaord team</p>\n<p>Access differentiated between HR Teams or just HR Admin</p>\n<p>share Active flag file</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>'),
(7, 33, 27, '<p>xs dasd sadasd qsssssss&nbsp;</p>'),
(9, 30, 24, '<p>Communication Plan for impacts to downstream systems &amp; applications due to the changes to the current integration.Cross functional Communication item</p>\n<p>The Photo should sync over to Workday and should be available in Surf if REFM/other Team want to use it for badge</p>\n<p>Business Title&nbsp; Add&nbsp;<br /><br /></p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p><u>Global HR Profile tbl</u></p>\n<p><u>&nbsp;</u></p>\n<p>Company&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SURF rule?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\n<p>Employment status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SURF rule?</p>\n<p>Manager Role</p>\n<p>Probation End Date</p>\n<p>Probation Period</p>\n<p>Company Code&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "Legal Entity Code ( 1000 for US)</p>\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; IF we &nbsp;add the company name does it break any dependancies?</p>\n<p>&nbsp;</p>\n<p><u>SCOPED HR Profile</u></p>\n<p>&nbsp;</p>\n<p>Department&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; currently numeric value plus name. IF we &nbsp;add the department name does it break any dependancies</p>\n<p>Offboard type&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; definition and is any app using it?&nbsp;</p>\n<p>User First Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Is it preferred or legal Name? Re-purpose appropriately&nbsp;</p>\n<p>User Middle Name&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Is it preferred or legal? Re-purpose appropriately&nbsp;</p>\n<p>User Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Is it preferred or legal? &nbsp; Re-purpose appropriately&nbsp;</p>\n<p>&nbsp;</p>\n<p><span style="text-decoration: underline;">Locations</span></p>\n<p>Number of Security, Cafeteria and Other Non-Employees</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>'),
(10, 28, 38, '<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<table style="border-collapse: collapse; width: 100%;" border="1">\n<tbody>\n<tr style="height: 17px;">\n<td style="width: 44.8551%; height: 17px;">&nbsp;</td>\n<td style="width: 5.14493%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n</tr>\n<tr style="height: 34px;">\n<td style="width: 44.8551%; height: 34px;">personal success tool w goal tracking and public profile&nbsp;</td>\n<td style="width: 5.14493%; height: 34px;">&nbsp;</td>\n<td style="width: 25%; height: 34px;">&nbsp;</td>\n<td style="width: 25%; height: 34px;">&nbsp;</td>\n</tr>\n<tr style="height: 34px;">\n<td style="width: 44.8551%; height: 34px;">stand-alone browser pop up where user can quickly enter notes or to-do task..icons to select type .. checklist, to do list, goal etc</td>\n<td style="width: 5.14493%; height: 34px;">&nbsp;</td>\n<td style="width: 25%; height: 34px;">&nbsp;</td>\n<td style="width: 25%; height: 34px;">&nbsp;</td>\n</tr>\n<tr style="height: 17px;">\n<td style="width: 44.8551%; height: 17px;">audio microphone recording for each Action Item via an microphone icon</td>\n<td style="width: 5.14493%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n</tr>\n<tr style="height: 35px;">\n<td style="width: 44.8551%; height: 35px;">Response closed by default opens by clicking on the + icon</td>\n<td style="width: 5.14493%; height: 35px;">&nbsp;</td>\n<td style="width: 25%; height: 35px;">&nbsp;</td>\n<td style="width: 25%; height: 35px;">&nbsp;</td>\n</tr>\n<tr style="height: 17px;">\n<td style="width: 44.8551%; height: 17px;">neater follow ups row view</td>\n<td style="width: 5.14493%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n</tr>\n<tr style="height: 17px;">\n<td style="width: 44.8551%; height: 17px;">change the URL in "added or updated a follow" subject s/b #Username# has&nbsp;added or updated an action item. Url should point to&nbsp;<a href="updates?id=">http://projectfollowups.dev/category/updates?id=</a>&nbsp;where id = id of topic</td>\n<td style="width: 5.14493%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n</tr>\n<tr style="height: 17px;">\n<td style="width: 44.8551%; height: 17px;">Full page view of this notes page does not show the notes menu. ctrl-shift-f</td>\n<td style="width: 5.14493%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n</tr>\n<tr style="height: 17px;">\n<td style="width: 44.8551%; height: 17px;">Excel like grid .. user enters their own labels.. default create 100 rows, first column 1 to 100 but editable. also each row should have internal id which is hidden. user s/b able to mark which one to show as header and sort w/o effecting&nbsp;</td>\n<td style="width: 5.14493%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n</tr>\n<tr style="height: 17px;">\n<td style="width: 44.8551%; height: 17px;">&nbsp;</td>\n<td style="width: 5.14493%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n</tr>\n<tr style="height: 17px;">\n<td style="width: 44.8551%; height: 17px;">&nbsp;</td>\n<td style="width: 5.14493%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n<td style="width: 25%; height: 17px;">&nbsp;</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p>&nbsp;</p>'),
(11, 30, 39, '<p>V</p>'),
(975, 30, 43, '<p>&nbsp;</p>\n<p><a href="https://servicenow-my.sharepoint.com/personal/sriram_kumarakris_servicenow_com/_layouts/15/onedrive.aspx?e=5%3Ac7debb4850d6426580b1c686f48e76bb&amp;FolderCTID=0x01200095105B02CB4E3A49BDD5EFD90077FF65&amp;id=%2Fsites%2Fhumanresources%2FShared%20Documents%2FProjects%2FGlobal%20Enterprise%20Onboarding%2F02-SDLC%20Define%20Design%2FWorking%20Documents%2FIntegration%20Reference%20Docs%2FIntegration%201%2E0%20Docs&amp;listurl=https%3A%2F%2Fservicenow%2Esharepoint%2Ecom%2Fsites%2Fhumanresources%2FShared%20Documents">https://servicenow-my.sharepoint.com/personal/sriram_kumarakris_servicenow_com/_layouts/15/onedrive.aspx?e=5%3Ac7debb4850d6426580b1c686f48e76bb&amp;FolderCTID=0x01200095105B02CB4E3A49BDD5EFD90077FF65&amp;id=%2Fsites%2Fhumanresources%2FShared%20Documents%2FProjects%2FGlobal%20Enterprise%20Onboarding%2F02-SDLC%20Define%20Design%2FWorking%20Documents%2FIntegration%20Reference%20Docs%2FIntegration%201%2E0%20Docs&amp;listurl=https%3A%2F%2Fservicenow%2Esharepoint%2Ecom%2Fsites%2Fhumanresources%2FShared%20Documents</a></p>');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `status`, `create_time`, `update_time`) VALUES
(1, 'My First Blog', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis bibendum pretium leo, in ullamcorper lacus sollicitudin vel. Aenean nec tincidunt turpis. Phasellus semper urna eu risus rutrum, ut maximus diam cursus. Cras facilisis metus nec imperdiet placerat. Nullam ac ex tempor, convallis leo vel, vulputate ante. Cras varius finibus dolor. Duis laoreet, ex et auctor cursus, mi diam posuere nisl, a tristique augue lectus nec ante. Nullam quis gravida nisl. Duis sapien velit, imperdiet eu lorem a, dignissim venenatis nunc.\r\n\r\nAliquam erat quam, convallis a nisl ut, suscipit congue justo. Sed auctor, neque et convallis cursus, libero eros blandit tortor, id mollis orci augue eu nunc. Pellentesque gravida, velit et suscipit aliquet, eros nunc blandit nunc, id rhoncus metus neque id leo. Integer condimentum porta tellus, mollis mollis sem vehicula a. Phasellus vel magna tortor. Nam tincidunt facilisis lorem, quis fringilla nisi aliquet ac. Vestibulum ac rutrum tortor. Proin convallis eros est, eget maximus libero malesuada a. In eget felis enim. Nunc interdum velit eu risus euismod varius. Nunc accumsan quis nisl at fermentum. Nam quis enim tellus. Praesent non purus leo. Nunc sollicitudin justo quis nibh vehicula iaculis sed blandit sapien.', 1, '2018-06-20 07:18:40', '2018-06-20 07:18:40'),
(2, 'My Second Blog Post', 'Duis ipsum sem, pretium nec lacus vel, interdum dictum elit. Cras eu diam nulla. Phasellus consectetur tortor libero, eu eleifend magna aliquam ut. Integer at felis felis. Ut pharetra ultricies tellus, quis pulvinar nulla dignissim ac. Phasellus tincidunt dolor nunc. Duis orci libero, fermentum convallis turpis et, aliquet aliquet leo. Maecenas aliquet et urna id malesuada. Nullam pharetra nisi ut faucibus rutrum. Curabitur condimentum efficitur dui, nec porta metus posuere vitae.\r\n\r\nSed venenatis suscipit nulla nec scelerisque. Quisque dictum pellentesque ex in sollicitudin. Cras molestie lacinia scelerisque. Nulla sagittis massa a ullamcorper efficitur. Nullam feugiat tempus posuere. Vivamus posuere, arcu accumsan rutrum bibendum, dui mauris blandit nisi, sed condimentum dui sapien sit amet tellus. Pellentesque pellentesque lectus dui, in fringilla mi tincidunt quis. Fusce iaculis metus dui, sit amet ornare ligula eleifend tempus. Curabitur a nibh auctor, feugiat arcu id, volutpat mauris. Vivamus a velit et arcu dignissim molestie ac eu magna. Praesent sagittis porta lorem, ut ornare elit ullamcorper ac. Quisque faucibus elit ut ligula lacinia feugiat. Phasellus pellentesque consequat ex eget ultricies. Suspendisse potenti. Praesent nec neque leo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.\r\n\r\nCras iaculis dictum viverra. Curabitur ut rhoncus lectus, at fermentum purus. Nulla porttitor sollicitudin hendrerit. Donec finibus mi ut ante fringilla, vitae egestas odio fringilla. Ut iaculis maximus nisi. Vivamus vitae elementum ipsum. Curabitur id iaculis quam, vulputate dapibus quam.', 1, '2018-06-20 07:25:01', '2018-06-20 07:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `assigned_to` varchar(100) NOT NULL DEFAULT 'Myself',
  `phase` varchar(10) NOT NULL DEFAULT 'TBD',
  `status` varchar(100) NOT NULL DEFAULT 'New',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `custom_field` varchar(100) DEFAULT 'TBD',
  `more_info` text,
  `rating` varchar(10) NOT NULL DEFAULT 'TBD',
  `priority` varchar(10) NOT NULL DEFAULT 'Medium',
  `sort_order` varchar(255) DEFAULT 'N/A',
  `percentage_complete` varchar(255) DEFAULT 'N/A',
  `stake_holder` varchar(255) DEFAULT 'TBD',
  `is_focus` tinyint(4) NOT NULL DEFAULT '0',
  `is_hide` varchar(4) DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `category_id`, `title`, `assigned_to`, `phase`, `status`, `start_date`, `end_date`, `custom_field`, `more_info`, `rating`, `priority`, `sort_order`, `percentage_complete`, `stake_holder`, `is_focus`, `is_hide`) VALUES
(86, 28, 20, 'Project 1', 'Myself', 'TBD', 'New', '2018-03-25', '2018-04-08', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(87, 28, 20, 'Project 2', 'Myself', 'TBD', 'New', '2018-03-25', '2018-04-08', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(88, 28, 20, 'Project 3', 'Myself', 'TBD', 'New', '2018-03-25', '2018-04-08', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(89, 28, 20, 'Project 4', 'Myself', 'TBD', 'New', '2018-03-25', '2018-04-08', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(90, 28, 20, 'Project 5', 'Myself', 'TBD', 'New', '2018-03-25', '2018-04-08', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(91, 28, 21, 'Project 1', 'Myself', 'TBD', 'New', '2018-03-25', '2018-04-08', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(92, 28, 21, 'Project 2', 'Myself', 'TBD', 'New', '2018-03-25', '2018-04-08', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(93, 28, 21, 'Project 3', 'Myself', 'TBD', 'New', '2018-03-25', '2018-04-08', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(94, 28, 21, 'Project 4', 'Myself', 'TBD', 'New', '2018-03-25', '2018-04-08', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(95, 28, 21, 'Project 5', 'Myself', 'TBD', 'New', '2018-03-25', '2018-04-08', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(101, 28, 23, 'Project 1', 'Myself', 'TBD', 'New', '2018-03-26', '2018-04-09', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(102, 28, 23, 'Project 2', 'Myself', 'TBD', 'New', '2018-03-26', '2018-04-09', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(103, 28, 23, 'Project 3', 'Myself', 'TBD', 'New', '2018-03-26', '2018-04-09', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(104, 28, 23, 'Project 4', 'Myself', 'TBD', 'New', '2018-03-26', '2018-04-09', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(105, 28, 23, 'Project 5', 'Myself', 'TBD', 'New', '2018-03-26', '2018-04-09', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(107, 30, 24, 'SP interactions', 'Myself', 'TBD', 'awaiting review', '2018-04-03', '2018-04-17', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(110, 30, 24, 'Rescind Process Req\'ts', 'Myself', 'TBD', 'New', '2018-04-03', '2018-04-17', 'StorySTRY1153635 ', '<p>BRD Reqt:</p>\r\n<ul>\r\n<li>If the new hire worker record is rescinded in Workday it should be inactivated or deleted (TBD &ndash; need to be discussed during the design discussions. How to handle the LE Case/HR Cases and records in the downstream systems?)</li>\r\n</ul>', 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(121, 33, 27, 'Project 1', 'Myself', 'TBD', 'New', '2018-04-05', '2018-04-19', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(122, 33, 27, 'Project 2', 'Myself', 'TBD', 'New', '2018-04-05', '2018-04-19', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 1, 'No'),
(123, 33, 27, 'Project 3', 'Myself', 'TBD', 'New', '2018-04-05', '2018-04-19', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 1, 'No'),
(124, 33, 27, 'Project 4', 'Myself', 'TBD', 'New', '2018-04-05', '2018-04-19', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 1, 'No'),
(125, 33, 27, 'Project 5', 'Myself', 'TBD', 'New', '2018-04-05', '2018-04-19', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(131, 28, 29, 'Project 1', 'Myself', 'TBD', 'New', '2018-04-06', '2018-04-20', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(132, 28, 29, 'Project 2', 'Myself', 'TBD', 'New', '2018-04-06', '2018-04-20', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(133, 28, 29, 'Project 3', 'Myself', 'TBD', 'New', '2018-04-06', '2018-04-20', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(134, 28, 29, 'Project 4', 'Myself', 'TBD', 'New', '2018-04-06', '2018-04-20', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(135, 28, 29, 'Project 5', 'Myself', 'TBD', 'New', '2018-04-06', '2018-04-20', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(136, 35, 30, 'Project 1', 'Myself', 'TBD', 'New', '2018-04-10', '2018-04-24', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(137, 35, 30, 'Project 2', 'Myself', 'TBD', 'New', '2018-04-10', '2018-04-24', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(138, 35, 30, 'Project 3', 'Myself', 'TBD', 'New', '2018-04-10', '2018-04-24', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(140, 35, 30, 'Project 5', 'Myself', 'TBD', 'New', '2018-04-10', '2018-04-24', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(143, 30, 31, 'Project 1', 'Myself', 'TBD', 'New', '2018-04-11', '2018-04-25', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(144, 30, 31, 'Project 2', 'Myself', 'TBD', 'New', '2018-04-11', '2018-04-25', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(145, 30, 31, 'Project 3', 'Myself', 'TBD', 'New', '2018-04-11', '2018-04-25', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(146, 30, 31, 'Project 4', 'Myself', 'TBD', 'New', '2018-04-11', '2018-04-25', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(147, 30, 31, 'Project 5', 'Myself', 'TBD', 'New', '2018-04-11', '2018-04-25', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(148, 28, 32, 'Project 1', 'Myself', 'TBD', 'New', '2018-04-16', '2018-04-30', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(149, 28, 32, 'Project 2', 'Myself', 'TBD', 'New', '2018-04-16', '2018-04-30', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(150, 28, 32, 'Project 3', 'Myself', 'TBD', 'New', '2018-04-16', '2018-04-30', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(151, 28, 32, 'Project 4', 'Myself', 'TBD', 'New', '2018-04-16', '2018-04-30', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(152, 28, 32, 'Project 5', 'Myself', 'TBD', 'New', '2018-04-16', '2018-04-30', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(153, 30, 33, 'New Scoped HR Profile Structure', ' ', '     ', 'draft', '2018-04-19', '2018-05-03', 'STRY1149570', '<p><a href="https://surf.service-now.com/nav_to.do?uri=rm_story.do?sys_id=0cc474cadba59f406bc4ff661d961908%26sysparm_view=scrum">link to story</a></p>', 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(154, 30, 33, 'Updates to the WD to Surf Integration ', 'Myself', 'TBD', 'draft', '2018-04-19', '2018-05-03', 'STRY1150370', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(155, 30, 33, 'Active Flag rules', 'Myself', 'TBD', 'draft', '2018-04-19', '2018-05-03', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(156, 30, 33, 'employee tbl', 'Myself', 'TBD', 'draft', '2018-04-19', '2018-05-03', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(157, 30, 33, 'job profile tbl', 'Myself', 'TBD', 'draft', '2018-04-19', '2018-05-03', 'StorySTRY1151086 ', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(158, 28, 34, 'Project 1', 'Myself', 'TBD', 'New', '2018-04-22', '2018-05-06', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(159, 28, 34, 'Project 2', 'Myself', 'TBD', 'New', '2018-04-22', '2018-05-06', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(160, 28, 34, 'Project 3', 'Myself', 'TBD', 'New', '2018-04-22', '2018-05-06', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(161, 28, 34, 'Project 4', 'Myself', 'TBD', 'New', '2018-04-22', '2018-05-06', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(162, 28, 34, 'Project 5', 'Myself', 'TBD', 'New', '2018-04-22', '2018-05-06', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(168, 39, 36, 'Project 1', 'Myself', 'TBD', 'New', '2018-04-22', '2018-05-06', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(169, 39, 36, 'Project 2', 'Myself', 'TBD', 'New', '2018-04-22', '2018-05-06', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(170, 39, 36, 'Project 3', 'Myself', 'TBD', 'New', '2018-04-22', '2018-05-06', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(171, 39, 36, 'Project 4', 'Myself', 'TBD', 'New', '2018-04-22', '2018-05-06', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(172, 39, 36, 'Project 5', 'Myself', 'TBD', 'New', '2018-04-22', '2018-05-06', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(173, 30, 33, 'Scoped HR Profile data updates', 'Myself', 'TBD', 'New', '2018-04-22', '2018-05-06', 'StorySTRY1151826 ', '', 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(175, 30, 33, 'Holiday calendar', 'Myself', 'TBD', 'Need mapping', '2018-04-23', '2018-05-07', 'StorySTRY1153752 ', 'StorySTRY1153752 ', 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(176, 30, 33, 'SAP Stories??', 'Myself', 'TBD', 'New', '2018-04-23', '2018-05-07', 'TBD', '', 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(177, 30, 33, 'Scoped HR Profile to Workday Integration for work email and Work phone', 'Myself', 'TBD', 'review', '2018-04-23', '2018-05-07', 'StorySTRY1153886 ', '', 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(178, 30, 37, 'Project 1', 'Myself', 'TBD', 'New', '2018-04-23', '2018-05-07', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(179, 30, 37, 'Project 2', 'Myself', 'TBD', 'New', '2018-04-23', '2018-05-07', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(180, 30, 37, 'Project 3', 'Myself', 'TBD', 'New', '2018-04-23', '2018-05-07', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(181, 30, 37, 'Project 4', 'Myself', 'TBD', 'New', '2018-04-23', '2018-05-07', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(182, 30, 37, 'Project 5', 'Myself', 'TBD', 'New', '2018-04-23', '2018-05-07', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(183, 30, 33, 'LE Parent Case fields', 'Myself', 'TBD', 'New', '2018-04-23', '2018-05-07', 'StorySTRY1159238 ', '', 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(184, 30, 33, 'Integration of New Hire Profile from Onb app to WD ', 'Myself', 'TBD', 'New', '2018-04-24', '2018-05-08', 'StorySTRY1155306 ', '', 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(185, 30, 33, 'new Onboarding staging table', 'Myself', 'TBD', 'New', '2018-04-24', '2018-05-08', 'STRY1155786 ', '', 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(187, 28, 38, 'Project 1', 'Myself', 'TBD', 'New', '2018-04-27', '2018-05-11', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(188, 28, 38, 'Project 2', 'Myself', 'TBD', 'New', '2018-04-27', '2018-05-11', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(189, 28, 38, 'Project 3', 'Myself', 'TBD', 'New', '2018-04-27', '2018-05-11', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(190, 28, 38, 'Project 4', 'Myself', 'TBD', 'New', '2018-04-27', '2018-05-11', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(191, 28, 38, 'Project 5', 'Myself', 'TBD', 'New', '2018-04-27', '2018-05-11', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(192, 30, 39, 'Project 1', 'Myself', 'TBD', 'New', '2018-05-08', '2018-05-22', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(193, 30, 39, 'Project 2', 'Myself', 'TBD', 'New', '2018-05-08', '2018-05-22', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(194, 30, 39, 'Project 3', 'Myself', 'TBD', 'New', '2018-05-08', '2018-05-22', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(195, 30, 39, 'Project 4', 'Myself', 'TBD', 'New', '2018-05-08', '2018-05-22', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(196, 30, 39, 'Project 5', 'Myself', 'TBD', 'New', '2018-05-08', '2018-05-22', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(197, 28, 40, 'Project 1', 'Myself', 'TBD', 'New', '2018-05-10', '2018-05-24', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(198, 28, 40, 'Project 2', 'Myself', 'TBD', 'New', '2018-05-10', '2018-05-24', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(199, 28, 40, 'Project 3', 'Myself', 'TBD', 'New', '2018-05-10', '2018-05-24', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(200, 28, 40, 'Project 4', 'Myself', 'TBD', 'New', '2018-05-10', '2018-05-24', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(201, 28, 40, 'Project 5', 'Myself', 'TBD', 'New', '2018-05-10', '2018-05-24', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(202, 30, 41, 'Project 1', 'Myself', 'TBD', 'New', '2018-05-14', '2018-05-28', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(203, 30, 41, 'Project 2', 'Myself', 'TBD', 'New', '2018-05-14', '2018-05-28', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(204, 30, 41, 'Project 3', 'Myself', 'TBD', 'New', '2018-05-14', '2018-05-28', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(205, 30, 41, 'Project 4', 'Myself', 'TBD', 'New', '2018-05-14', '2018-05-28', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(206, 30, 41, 'Project 5', 'Myself', 'TBD', 'New', '2018-05-14', '2018-05-28', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(207, 30, 42, 'Project 1', 'Myself', 'TBD', 'New', '2018-05-14', '2018-05-28', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(208, 30, 42, 'Project 2', 'Myself', 'TBD', 'New', '2018-05-14', '2018-05-28', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(209, 30, 42, 'Project 3', 'Myself', 'TBD', 'New', '2018-05-14', '2018-05-28', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(210, 30, 42, 'Project 4', 'Myself', 'TBD', 'New', '2018-05-14', '2018-05-28', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(211, 30, 42, 'Project 5', 'Myself', 'TBD', 'New', '2018-05-14', '2018-05-28', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(212, 30, 43, 'Project 1', 'Myself', 'TBD', 'New', '2018-05-18', '2018-06-01', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(213, 30, 43, 'Project 2', 'Myself', 'TBD', 'New', '2018-05-18', '2018-06-01', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(214, 30, 43, 'Project 3', 'Myself', 'TBD', 'New', '2018-05-18', '2018-06-01', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(215, 30, 43, 'Project 4', 'Myself', 'TBD', 'New', '2018-05-18', '2018-06-01', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(216, 30, 43, 'Project 5', 'Myself', 'TBD', 'New', '2018-05-18', '2018-06-01', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(217, 30, 24, 'cross functional prep', 'Myself', 'TBD', 'WIP', '2018-05-22', '2018-06-05', 'TBD', '', 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(218, 30, 24, 'day 1/past dated hires ', 'Myself', 'TBD', 'New', '2018-05-22', '2018-06-05', 'TBD', '', 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(219, 30, 24, 'Ad hoc sync design/error ', 'Myself', 'TBD', 'New', '2018-05-22', '2018-06-05', 'TBD', '', 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(220, 30, 24, 'Holiday story', 'Myself', 'TBD', 'New', '2018-05-22', '2018-06-05', 'TBD', '', 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(221, 52, 44, 'Project 1', 'Myself', 'TBD', 'New', '2018-06-04', '2018-06-18', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(222, 52, 44, 'Project 2', 'Myself', 'TBD', 'New', '2018-06-04', '2018-06-18', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(223, 52, 44, 'Project 3', 'Myself', 'TBD', 'New', '2018-06-04', '2018-06-18', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(224, 52, 44, 'Project 4', 'Myself', 'TBD', 'New', '2018-06-04', '2018-06-18', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(225, 52, 44, 'Project 5', 'Myself', 'TBD', 'New', '2018-06-04', '2018-06-18', 'TBD', NULL, 'TBD', 'Medium', 'N/A', 'N/A', 'TBD', 0, 'No'),
(226, 52, 44, 'First Project', 'Sadiya', 'Phase 1', 'Open', '2018-06-12', '2018-06-28', 'TBD', 'Some sample text will be here.', 'TBD', 'High', 'N/A', 'N/A', 'Farheen', 0, 'No'),
(227, 52, 44, 'First Project', 'Sadiya', 'Phase 1', 'Open', '2018-06-12', '2018-06-28', 'TBD', 'Some sample text will be here.', 'TBD', 'High', 'N/A', 'N/A', 'Farheen', 0, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `project_updates`
--

CREATE TABLE `project_updates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `update_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_updates`
--

INSERT INTO `project_updates` (`id`, `user_id`, `project_id`, `update_id`) VALUES
(1, 28, 86, 10),
(2, 28, 86, 11),
(3, 28, 86, 12),
(4, 28, 86, 13),
(5, 28, 86, 14),
(6, 28, 86, 15),
(11, 28, 86, 24),
(12, 28, 102, 25),
(14, 30, 153, 47),
(15, 30, 153, 48),
(16, 30, 153, 49),
(17, 52, 227, 124),
(18, 52, 227, 125);

-- --------------------------------------------------------

--
-- Table structure for table `pulse`
--

CREATE TABLE `pulse` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `how_you_feel` text NOT NULL,
  `about_project_health` text NOT NULL,
  `any_notes` text NOT NULL,
  `action_taken` text NOT NULL,
  `is_agenda` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `rating` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `social_account`
--

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social_account`
--

INSERT INTO `social_account` (`id`, `user_id`, `provider`, `client_id`, `data`, `code`, `created_at`, `email`, `username`) VALUES
(2, 28, 'google', '118108705198156860204', '{"kind":"plus#person","etag":"\\"EhMivDE25UysA1ltNG8tqFM2v-A/hbwtFJtU-ZYmsQu7J4fzkIcTDTY\\"","gender":"male","emails":[{"value":"8887400@gmail.com","type":"account"}],"objectType":"person","id":"118108705198156860204","displayName":"Mohammad Asaf","name":{"familyName":"Asaf","givenName":"Mohammad"},"url":"https://plus.google.com/118108705198156860204","image":{"url":"https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50","isDefault":true},"isPlusUser":true,"language":"en","circledByCount":18,"verified":false}', NULL, NULL, NULL, NULL),
(5, 28, 'linkedin', 'CLT9cVYcbg', '{"id":"CLT9cVYcbg","email-address":"8887400@gmail.com","first-name":"Mohammad","last-name":"Asaf","email":"8887400@gmail.com","first_name":"Mohammad","last_name":"Asaf"}', NULL, NULL, '8887400@gmail.com', NULL),
(6, 33, 'linkedin', 'ZiUhmcQMag', '{"id":"ZiUhmcQMag","email-address":"saladinian@gmail.com","first-name":"Hamza","last-name":"Awan","public-profile-url":"https://www.linkedin.com/in/hamza-awan-1a8681111","email":"saladinian@gmail.com","first_name":"Hamza","last_name":"Awan"}', NULL, NULL, NULL, NULL),
(7, 35, 'google', '118066786656810164191', '{"kind":"plus#person","etag":"\\"EhMivDE25UysA1ltNG8tqFM2v-A/iI1BEc2IRAEhRgkDFoh94L0YIFY\\"","emails":[{"value":"afzal441@gmail.com","type":"account"}],"objectType":"person","id":"118066786656810164191","displayName":"Mohammad Afdal","name":{"familyName":"Afdal","givenName":"Mohammad"},"image":{"url":"https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50","isDefault":true},"isPlusUser":false,"language":"en","verified":false}', NULL, NULL, NULL, NULL),
(8, 36, 'google', '105670422756986743854', '{"kind":"plus#person","etag":"\\"EhMivDE25UysA1ltNG8tqFM2v-A/Y3yzTITNaMe2J3h4jwiL-y6HZZE\\"","emails":[{"value":"waqasa3900@gmail.com","type":"account"}],"objectType":"person","id":"105670422756986743854","displayName":"Waqas Ahmed","name":{"familyName":"Ahmed","givenName":"Waqas"},"url":"https://plus.google.com/105670422756986743854","image":{"url":"https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50","isDefault":true},"isPlusUser":true,"language":"en","circledByCount":0,"verified":false}', NULL, NULL, NULL, NULL),
(9, 37, 'google', '101105545451022081640', '{"kind":"plus#person","etag":"\\"EhMivDE25UysA1ltNG8tqFM2v-A/ZhoFBl6XvzKlou-OsWH9GThxdHc\\"","emails":[{"value":"faysalali534@gmail.com","type":"account"}],"objectType":"person","id":"101105545451022081640","displayName":"Faisal Ali","name":{"familyName":"Ali","givenName":"Faisal"},"image":{"url":"https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50","isDefault":true},"isPlusUser":false,"language":"en","verified":false}', NULL, NULL, NULL, NULL),
(10, 33, 'google', '117606656718292700907', '{"kind":"plus#person","etag":"\\"EhMivDE25UysA1ltNG8tqFM2v-A/EjEdHGb0x0VWMK5uAamHXmMp8gc\\"","gender":"male","emails":[{"value":"saladinian@gmail.com","type":"account"}],"objectType":"person","id":"117606656718292700907","displayName":"Hamza Awan","name":{"familyName":"Awan","givenName":"Hamza"},"url":"https://plus.google.com/117606656718292700907","image":{"url":"https://lh5.googleusercontent.com/-Jq5_WcI1GQs/AAAAAAAAAAI/AAAAAAAACSM/VGH73cuFLxk/photo.jpg?sz=50","isDefault":false},"isPlusUser":true,"language":"en","circledByCount":22,"verified":false}', NULL, NULL, 'saladinian@gmail.com', NULL),
(11, 39, 'google', '115142851214500311196', '{"kind":"plus#person","etag":"\\"EhMivDE25UysA1ltNG8tqFM2v-A/EZ3evTRqMfMX-su9pVGpQoIykXQ\\"","gender":"female","emails":[{"value":"purple.safa@gmail.com","type":"account"}],"objectType":"person","id":"115142851214500311196","displayName":"Safa M","name":{"familyName":"M","givenName":"Safa"},"tagline":"My name is Safa and right now life is pretty great', NULL, NULL, NULL, NULL),
(13, 48, 'google', '111894983642196658682', '{"kind":"plus#person","etag":"\\"EhMivDE25UysA1ltNG8tqFM2v-A/EEqqeuk8n6U9w9s754P44TdP7sw\\"","gender":"male","emails":[{"value":"ssshaikh@gmail.com","type":"account"}],"objectType":"person","id":"111894983642196658682","displayName":"Shahid Shaikh","name":{"familyName":"Shaikh","givenName":"Shahid"},"url":"https://plus.google.com/111894983642196658682","image":{"url":"https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50","isDefault":true},"isPlusUser":true,"language":"en","circledByCount":8,"verified":false}', NULL, NULL, NULL, NULL),
(14, 50, 'google', '112042421207289929068', '{"kind":"plus#person","etag":"\\"RKS4-q7QGL10FxltAebpjqjKQR0/1Kv1qZIm5zhsEkMZRHwjqsjxfho\\"","occupation":"Web Developer","gender":"female","emails":[{"value":"fw.ansaris@gmail.com","type":"account"}],"objectType":"person","id":"112042421207289929068","displayName":"Ansari Sadiya","name":{"familyName":"Sadiya","givenName":"Ansari"},"url":"https://plus.google.com/112042421207289929068","image":{"url":"https://lh4.googleusercontent.com/-OxX4OgjXOaI/AAAAAAAAAAI/AAAAAAAAAFw/o2jDZOv-8Ug/photo.jpg?sz=50","isDefault":false},"organizations":[{"name":"University of Nagpur","title":"Commerce","type":"school","primary":false}],"placesLived":[{"value":"Nagpur","primary":true}],"isPlusUser":true,"language":"en","circledByCount":12,"verified":false}', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `assigned_to` varchar(100) NOT NULL DEFAULT 'Myself',
  `phase` varchar(10) NOT NULL DEFAULT 'TBD',
  `status` varchar(100) NOT NULL DEFAULT 'New',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `custom_field` varchar(100) DEFAULT NULL,
  `more_info` text NOT NULL,
  `rating` varchar(10) NOT NULL DEFAULT 'TBD'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
(52, '4-GnNuvj1mSphXFCpZ5mPE2GdToSbvFl', 1528136257, 0);

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `id` int(11) NOT NULL,
  `update_type` varchar(20) NOT NULL,
  `update_text` text NOT NULL,
  `response` text,
  `assigned_to` text,
  `is_close` int(11) NOT NULL DEFAULT '0',
  `due_date` date DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`id`, `update_type`, `update_text`, `response`, `assigned_to`, `is_close`, `due_date`, `date`) VALUES
(3, 'Follow Up', 'change Follow Up label to "Action Item"', 'Completed', '', 0, NULL, '2018-03-25'),
(4, 'Follow Up', 'move fileters to same row as previous updates', 'Not working after you edit the row', '', 0, NULL, '2018-03-25'),
(7, 'Follow Up', 'Add a new topic on home page', 'Completed', '', 0, NULL, '2018-03-25'),
(9, 'Notes', 'erytr', '', NULL, 0, NULL, '2018-03-25'),
(10, 'Decision', 'ryeryrtu', '', NULL, 1, NULL, '2018-03-25'),
(11, 'Decision', 'tueru', '', NULL, 1, NULL, '2018-03-25'),
(12, 'Concern', 'tyrt', '', NULL, 0, NULL, '2018-03-25'),
(13, 'Concern', 'rhtrhr', '', NULL, 0, NULL, '2018-03-25'),
(14, 'Accomplishment', 'gerg', '', NULL, 0, NULL, '2018-03-25'),
(15, 'Follow Up', 'fdh', '', 'rwet', 0, NULL, '2018-03-25'),
(17, 'Follow Up', 'asd', '', NULL, 0, NULL, '2018-03-26'),
(18, 'Decision', 'asd', '', NULL, 1, NULL, '2018-03-26'),
(19, 'Decision', 'asd', '', NULL, 1, NULL, '2018-03-26'),
(20, 'Decision', 'asd', '', NULL, 1, NULL, '2018-03-26'),
(21, 'Follow Up', 'asd', '', NULL, 0, NULL, '2018-03-26'),
(22, 'Follow Up', 'asd', '', NULL, 0, NULL, '2018-03-26'),
(23, 'Accomplishment', 'Test Accomplishment', '', NULL, 0, NULL, '2018-03-26'),
(24, 'Follow Up', 'sfsaf', '', NULL, 0, NULL, '2018-03-26'),
(25, 'Follow Up', 'tewt', '', NULL, 0, NULL, '2018-03-26'),
(27, 'Accomplishment', 'we did 20 pushups', '', NULL, 0, NULL, '2018-04-04'),
(30, 'Concern', 'new hire redirect to HRPortal', '', '', 0, NULL, '2018-04-06'),
(31, 'Concern', 'no scroll bar on https://surfeeqa.service-now.com/esc?id=surf_hr_case&sys_id=9e11ce7ddb11d700b2e2d34b5e9619a6', '', NULL, 0, NULL, '2018-04-06'),
(32, 'Concern', 'selection of dream team member is not clear', '', '', 0, NULL, '2018-04-06'),
(35, 'Concern', 'Due date concern', '', NULL, 0, NULL, '2018-04-07'),
(36, 'Follow Up', 'Employee profile can be displayed and edited at review ', '', NULL, 0, NULL, '2018-04-07'),
(37, 'Follow Up', 'Notification for dream team', '', NULL, 0, NULL, '2018-04-07'),
(38, 'Concern', 'Header K icons ', '', NULL, 0, NULL, '2018-04-07'),
(39, 'Follow Up', 'Notif for the dream team', '', NULL, 0, NULL, '2018-04-07'),
(40, 'Follow Up', 'NHO Attendance is Unassigned', '', NULL, 0, NULL, '2018-04-07'),
(41, 'Follow Up', 'Current functionality of "Ask a question" versus "Conversations"  should show up as a comment', '', NULL, 0, NULL, '2018-04-07'),
(42, 'Concern', 'ECR requests under completed and Open', '', NULL, 0, NULL, '2018-04-07'),
(45, 'Follow Up', 'Setup mtg', '', 'Yan ', 0, '2018-04-12', '2018-04-10'),
(46, 'Follow Up', 'HOA ', '', 'HOA', 0, '2018-05-23', '2018-04-16'),
(47, 'Follow Up', 'ACL - any direct edit?  HR Admin only', '', NULL, 0, NULL, '2018-04-19'),
(48, 'Follow Up', 'Review field types and LOVS', '', 'myself', 0, NULL, '2018-04-19'),
(49, 'Follow Up', 'Do we need to accomodate PII for WD to SURF fields?', '', 'rajni', 0, NULL, '2018-04-19'),
(51, 'Action Item', 'email link - to  email the entered notes ', '', NULL, 0, NULL, '2018-04-22'),
(52, 'Action Item', 'email link to dashboard for open critical items where due date 2 days away.', '', '', 0, NULL, '2018-04-22'),
(62, 'Action Item', 'Test Followup', '', 'l144210@lhr.nu.edu.pk', 0, NULL, '2018-04-22'),
(63, 'Action Item', 'Test Followup', '', 'l144210@lhr.nu.edu.pk', 0, NULL, '2018-04-22'),
(64, 'Action Item', 'Test Followup', '', 'l144210@lhr.nu.edu.pk', 0, NULL, '2018-04-22'),
(65, 'Action Item', 'Test Followup', '', 'l144210@lhr.nu.edu.pk', 0, NULL, '2018-04-22'),
(66, 'Action Item', 'Test Followup', '', 'l144210@lhr.nu.edu.pk', 0, NULL, '2018-04-22'),
(67, 'Action Item', 'Test Action Item', '', 'l144210@lhr.nu.edu.pk', 0, NULL, '2018-04-22'),
(68, 'Action Item', 'The Photo should sync over to Workday and should be available in Surf if  REFM/other Team want to use it for badge', 'Where in SURF should the photo go?\r\n\r\nBusiness Title  Add \r\nRequisition Remove if not used.\r\nJob Category Keep\r\nJob Family Keep\r\nJob Level ID Rename to "Job Level"\r\nJob Exempt  Add \r\nJob Billable  Add \r\nHiring Manager Remove if not used.\r\nSkills Required Remove if not used.\r\nAdditional Information Remove if not used.\r\nDepartment Remove if not used.\r\nDescription Remove if not used.\r\nTags Remove if not used.', 'Sadiya', 0, NULL, '2018-04-23'),
(70, 'Action Item', 'Home for these fields- will it be on temp tbl or scoped HR?', 'T-Shirt Size\r\nJacket Size\r\nDietary Restrictions(s)\r\nGraduation (Expected) Date\r\n', 'Rajni', 1, NULL, '2018-04-24'),
(72, 'Action Item', 'Scoped HR tbl UI Design', '', 'Rajni', 0, '2018-04-25', '2018-04-24'),
(73, 'Action Item', 'Reassess ACL\'s on the employee table - what needs to change', 'no changes. Who currently has access to it?\r\nsame ACL for any new changes ', 'HR IT ', 1, NULL, '2018-04-25'),
(75, 'Action Item', 'Photo process - Global ?', 'Pending Rachel', 'Rajni', 0, NULL, '2018-04-26'),
(78, 'Action Item', 'New student orientation, may 19 5 PM ', '', '', 0, '2018-05-19', '2018-04-27'),
(79, 'Action Item', 'For the new fields on scoped HR profile-indicate if they should be editable by HR Admin', 'Use the same ACL as on the legacy Table ', 'Rajni', 1, '2018-04-30', '2018-04-29'),
(80, 'Action Item', 'security analysis on Scope and empl tbl', '', 'VJ', 0, '2018-05-04', '2018-04-29'),
(81, 'Action Item', 'y', '', NULL, 0, NULL, '2018-04-29'),
(84, 'Action Item', 'Integration Cross functional impact prep meeting', 'Conversions\r\nActive flag confirm\r\nESQR – if analysis is complete\r\nPrep a list of cross functional changes and communication plan\r\nEffected apps\r\nIs Offboard Type being used/needed?\r\n\r\n•	3.1.1.6 Legal/Adjudication Team \r\no	Need the following information for an Employee/Intern\r\n?	Citizenship Status \r\n?	Nationality\r\nWhen is it needed?\r\nHow is it needed?\r\nSource: \r\nWhich Target tables:\r\nDoes it need to be added to any integration?\r\n•	LMS/SABA   \r\no	Include Worker Leave Status in Surf\r\nExact value expected?  Yes/No\r\nLeave Status added to Scoped HR and LMS shall pick it up based on their Update BR \r\n\r\ndefault groups - if not correct do a SE Story\r\n\r\nSP updates Active Flag to false on sysuser and HR Profile (As current process but transition to Scoped HR). \r\nWill SURF need to send a request to okta to disable account for rescinds?', 'MA', 0, NULL, '2018-04-30'),
(86, 'Action Item', 'need a data dump of all the data dump from WD that should be in Scoped HR Tbl', '', 'Rajni', 1, '2018-05-03', '2018-05-01'),
(88, 'Action Item', 'Downstream users will not be able to access the new fields directly from Scoped HR profile ie Leave and Bonus fields..Is that fine? they can be accessed via script though', '', 'Rajni', 0, '2018-05-04', '2018-05-02'),
(89, 'Action Item', 'TBD fields on employee tbl to review in cross funct meeting', '', 'MA', 0, '2018-05-08', '2018-05-03'),
(91, 'Action Item', 'testing by date', '', NULL, 0, NULL, '2018-05-05'),
(92, 'Action Item', 'Which alias to use for send Integration error notification ', 'Mule should send notif to the alias Andrea provides:\r\nWhat details should be contained in it? just the transportation details', 'MA', 0, '2018-05-11', '2018-05-08'),
(94, 'Action Item', 'filed trip', '', NULL, 0, '2018-05-14', '2018-05-10'),
(95, 'Action Item', 'dentist ', '', 'sadaf', 0, '2018-05-16', '2018-05-10'),
(100, 'Action Item', 'impact on existing cases wrt cases created via script', 'email notifications to new hires.. account already created-duplicate account will not .second notif will not be sent .. workaround manually send \r\n\r\nKamini/Shusant ', 'Dev team', 2, '1970-01-01', '2018-05-14'),
(102, 'Action Item', 'STRY5298935 - Solutioning for New Hire\'s Day 1 access to HR Portal ', '•	Awaiting below inputs from you \r\no	WD-Surf sync should be made consistent with Sailpoint Identity provisioning - Surf Team \r\no	Confirm feasibility of Encryption and Password Protection in the generated document - Surf Team  \r\no	Confirm the Surf task can be access-restricted to It-Support and users - Surf Team\r\n•	Need confirmation on the feasibility of the design\r\n•	Which Sprint is this planned for? What are the timelines for testing? Please share dates calling out SP dependency.\r\n \r\nLet’s ensure we lay down a realistic plan and stick with it. \r\n \r\nPlease provide these detail by end of Monday so that we can send business communication for this. \r\n \r\nThanks!\r\n \r\n \r\nParvathy P | Identity Management Developer\r\nFrom: Parvathy Prasanna Kumari <parvathy.prasannakumari@servicenow.com>\r\nDate: Tuesday, April 24, 2018 at 12:09 PM\r\nTo: Gireesh Patil <gireesh.patil@servicenow.com>\r\nCc: Prathibha C Adiseshamurthy <prathibha.chandrashekarapuraadiseshamurthy@servicenow.com>\r\nSubject: FW: Solutioning for New Hire\'s Day 1 access to HR Portal \r\n \r\nGireesh,\r\n \r\nGiven the finalized approach of SP sharing the AD password upon creation, do you think Surf can leverage the same to close the AD creation task during onboard? \r\nWith this design, we may be introducing redundancy by having a custom workflow to return AD status. \r\n \r\nLet me know your thoughts. \r\n\r\nParvathy P | Identity Mana\r\n\r\nFrom: Prathibha C Adiseshamurthy <prathibha.chandrashekarapuraadiseshamurthy@servicenow.com>\r\nDate: Friday, April 6, 2018 at 2:26 PM\r\nTo: Rachel Wong <Rachel.Wong@servicenow.com>, Gireesh Patil <gireesh.patil@servicenow.com>\r\nCc: Danielle Lulley <Danielle.Lulley@servicenow.com>, Gopinath Neelakanda <gopinath.neelakanda@servicenow.com>, Jenn Sharp <Jennifer.Sharp@servicenow.com>, Parvathy Prasanna Kumari <parvathy.prasannakumari@servicenow.com>, Deepali Bhoite <deepali.bhoite@servicenow.com>, Vinit Khera <vinit.khera@servicenow.com>, Vaijayanthi Rajagopalan <vaijayanthi.rajagopalan@servicenow.com>\r\nSubject: Re: Solutioning for New Hire\'s Day 1 access to HR Portal \r\n \r\n+Gireesh \r\n \r\nFrom: Prathibha C Adiseshamurthy <prathibha.chandrashekarapuraadiseshamurthy@servicenow.com>\r\nDate: Friday, April 6, 2018 at 2:26 PM\r\nTo: Rachel Wong <Rachel.Wong@servicenow.com>, Gireesh Patil <gireesh.patil@servicenow.com>\r\nCc: Danielle Lulley <Danielle.Lulley@servicenow.com>, Gopinath Neelakanda <gopinath.neelakanda@servicenow.com>, Jenn Sharp <Jennifer.Sharp@servicenow.com>, Parvathy Prasanna Kumari <parvathy.prasannakumari@servicenow.com>, Deepali Bhoite <deepali.bhoite@servicenow.com>, Vinit Khera <vinit.khera@servicenow.com>, Vaijayanthi Rajagopalan <vaijayanthi.rajagopalan@servicenow.com>\r\nSubject: Re: Solutioning for New Hire\'s Day 1 access to HR Portal \r\n \r\n+Gireesh \r\n \r\nHi Rachel, \r\n \r\nWe have made progress on this. IAM/Sailpoint team came up with analysis and new we have the directions that we would like to go forward with. \r\n \r\nApproach finalized: \r\n•	Sailpoint sends the AD password to Surf when the AD account is generated. IT Support will also receive the password  \r\n•	Surf generates a secure document with the credentials make this available on the hire date  \r\no	This document can be made to be auto sent to the new hire – A task auto closed by system can be created to track this activity\r\n \r\nSailpoint team and SURF team will be implementing this solution together. I have looped in @Gireesh from SURF team to drive the implementation from SURF side. \r\n \r\nBest,\r\nPrathibha\r\n \r\n \r\nFrom: Rachel Wong <Rachel.Wong@servicenow.com>\r\nDate: Friday, April 6, 2018 at 1:22 PM\r\nTo: Prathibha Chandrashekarapura Adiseshamurthy <prathibha.chandrashekarapuraadiseshamurthy@servicenow.com>, Gopinath Neelakanda <gopinath.neelakanda@servicenow.com>, Jenn Sharp <Jennifer.Sharp@servicenow.com>, Parvathy Prasanna Kumari <parvathy.prasannakumari@servicenow.com>, Deepali Bhoite <deepali.bhoite@servicenow.com>, Vinit Khera <vinit.khera@servicenow.com>, Vaijayanthi Rajagopalan <vaijayanthi.rajagopalan@servicenow.com>\r\nCc: Danielle Lulley <Danielle.Lulley@servicenow.com>\r\nSubject: RE: Solutioning for New Hire\'s Day 1 access to HR Portal \r\n \r\nHi there –  Can we regroup on this issue next week?  I couldn’t find a more updated thread but I’d like to get an update on the previous action items  for determining how/when to automate credential emails to new hires and confirm a plan for moving forward, as we are still sending new hires a manual email NHO Guide each Friday to ensure that they can still access the details they need to join NHO Webex/arrive to our offices.   \r\n \r\nThanks,\r\n_________________________________________\r\nRachel Wong | HR Business Systems Analyst\r\nServiceNow  | Work at Lightspeed\r\n(o) 669.262.2690  (f) 408.687.4508\r\nwww.servicenow.com \r\n \r\nFollow us: Facebook | Twitter | LinkedIn | Google+ | ServiceNow Community\r\n \r\nFrom: Prathibha C Adiseshamurthy \r\nSent: Wednesday, February 28, 2018 1:11 PM\r\nTo: Rachel Wong <Rachel.Wong@servicenow.com>\r\nCc: Prathibha C Adiseshamurthy <prathibha.chandrashekarapuraadiseshamurthy@servicenow.com>; Gopinath Neelakanda <gopinath.neelakanda@servicenow.com>; Jenn Sharp <Jennifer.Sharp@servicenow.com>; Parvathy Prasanna Kumari <parvathy.prasannakumari@servicenow.com>; Deepali Bhoite <deepali.bhoite@servicenow.com>; Vinit Khera <vinit.khera@servicenow.com>; Danielle Lulley <Danielle.Lulley@servicenow.com>; Vaijayanthi Rajagopalan <vaijayanthi.rajagopalan@servicenow.com>\r\nSubject: RE: Solutioning for New Hire\'s Day 1 access to HR Portal \r\n \r\nHi Rachel,  \r\n \r\nAs discussed we might need to communicate to new hires about their credential update until this is fixed. \r\n \r\nBest,\r\nPrathibha\r\n \r\nOn Feb 28, 2018 12:33 PM, Rachel Wong <Rachel.Wong@servicenow.com> wrote:\r\nHi Prathibha – If we aren’t meeting until next week, what is our plan for the first group of new hires that is set to start this coming Monday 3/5?  This is the first group of new hires that will have been onboarded via Enterprise Onboarding so I am just worried about having nothing in place for them.\r\n \r\n_________________________________________\r\nRachel Wong | HR Business Systems Analyst\r\nServiceNow  | Work at Lightspeed\r\n(o) 669.262.2690  (f) 408.687.4508\r\nwww.servicenow.com \r\n \r\nFollow us: Facebook | Twitter | LinkedIn | Google+ | ServiceNow Community\r\n \r\nFrom: Prathibha C Adiseshamurthy \r\nSent: Wednesday, February 28, 2018 12:27 PM\r\nTo: Rachel Wong <Rachel.Wong@servicenow.com>; Gopinath Neelakanda <gopinath.neelakanda@servicenow.com>; Jenn Sharp <Jennifer.Sharp@servicenow.com>; Parvathy Prasanna Kumari <parvathy.prasannakumari@servicenow.com>; Deepali Bhoite <deepali.bhoite@servicenow.com>; Vinit Khera <vinit.khera@servicenow.com>; Danielle Lulley <Danielle.Lulley@servicenow.com>; Vaijayanthi Rajagopalan <vaijayanthi.rajagopalan@servicenow.com>\r\nSubject: Re: Solutioning for New Hire\'s Day 1 access to HR Portal \r\n \r\nHi Rachel, \r\n \r\nYes, few options coming up. We shall meet again early next week to get this rolling. \r\n \r\nBest,\r\nPrathibha  \r\n \r\nFrom: Rachel Wong <Rachel.Wong@servicenow.com>\r\nDate: Wednesday, February 28, 2018 at 12:15 PM\r\nTo: Prathibha Chandrashekarapura Adiseshamurthy <prathibha.chandrashekarapuraadiseshamurthy@servicenow.com>, Gopinath Neelakanda <gopinath.neelakanda@servicenow.com>, Jenn Sharp <Jennifer.Sharp@servicenow.com>, Parvathy Prasanna Kumari <parvathy.prasannakumari@servicenow.com>, Deepali Bhoite <deepali.bhoite@servicenow.com>, Vinit Khera <vinit.khera@servicenow.com>, Danielle Lulley <Danielle.Lulley@servicenow.com>, Vaijayanthi Rajagopalan <vaijayanthi.rajagopalan@servicenow.com>\r\nSubject: RE: Solutioning for New Hire\'s Day 1 access to HR Portal \r\n \r\nHi all –  Since we ran out of time in our last meeting and haven’t finalized a solution yet, I think we need to do another design discussion – have we been able to gather any additional feedback on the action items from the last meeting, regarding the automation of the email to the new hires with their log in credentials?\r\n \r\nThanks,\r\n \r\n________________________________________\r\nRachel Wong | HR Business Systems Analyst\r\nServiceNow  | Work at Lightspeed\r\n(o) 669.262.2690  (f) 408.687.4508\r\nwww.servicenow.com \r\n \r\nFollow us: Facebook | Twitter | LinkedIn | Google+ | ServiceNow Community\r\n \r\n-----Original Appointment-----\r\nFrom: Prathibha C Adiseshamurthy \r\nSent: Wednesday, February 14, 2018 3:07 PM\r\nTo: Prathibha C Adiseshamurthy; Gopinath Neelakanda; Jenn Sharp; Parvathy Prasanna Kumari; Deepali Bhoite; Vinit Khera; Danielle Lulley; Rachel Wong; Vaijayanthi Rajagopalan\r\nSubject: Re: Solutioning for New Hire\'s Day 1 access to HR Portal \r\nWhen: Wednesday, February 21, 2018 3:00 PM-3:30 PM (UTC-08:00) Pacific Time (US & Canada).\r\nWhere: SJC VC B1 Coit Tower (8); SJC CR D1 Cutlass (9)\r\n \r\nAgenda:\r\nDisucss the option of sending login credentials to new hire on Day 1\r\n•	Send to personal email from Sailpoint on the date of hire \r\n•	Alternate solutions\r\n', 'Sadiya', 2, NULL, '2018-05-14'),
(103, 'Action Item', 'HI STRY5399978 refers to SURF STRY1029671custom workflow to check AD Account Provisioning status refers SURF story ', 'May 11, 2018, at 12:42 PM, Parvathy Prasanna Kumari <parvathy.prasannakumari@servicenow.com> wrote:\r\nGireesh,\r\n \r\nI need details on below 2 stories and the timelines for it. Both are pending your inputs. \r\n \r\nSTRY5399978 - Custom Workflow to check AD Account provisioning status\r\n                It was suggested that we mark this story and add this requirement to the scope of the below story. Else it will create redundant functions in both applications. Please confirm on this. \r\n', 'sPrashanthi1', 1, '1970-01-01', '2018-05-14'),
(104, 'Action Item', 'Safa grad', '', NULL, 0, '2018-05-31', '2018-05-14'),
(105, 'Action Item', 'iftar w/ Tabassum fam.Meharan.Sunday', '', NULL, 0, '2018-05-27', '2018-05-14'),
(106, 'Action Item', 'Summer school for Safa - starts July 9', '', '', 0, '2018-05-17', '2018-05-14'),
(107, 'Action Item', 'tst', '', NULL, 0, '2018-05-27', '2018-05-14'),
(110, 'Action Item', 'Holiday calendar open items', '*Cost center specific calendar-do not currently show up on SURF\r\n*Nov 1 show current and next year and starting on Jan 1 only current year on the /esc/calendar page\r\n*Amjad on functionality for next year', '', 0, NULL, '2018-05-16'),
(111, 'Action Item', 'company code "In Legacy Hr Profile  and Employee this field used as \'String\'. We can change it to refrence field and show company name. We have to change the code in Tango and IT  and employee as per this."', '', 'Sameer', 0, NULL, '2018-05-18'),
(113, 'Action Item', 'Define Same day hire process for HR profile and LE Case ', '', 'MA/team ', 0, NULL, '2018-05-20'),
(114, 'Action Item', 'Eid party june 17th, 1 pm fremont', '', NULL, 0, '2018-06-17', '2018-05-21'),
(115, 'Action Item', 'Employee on Visa and Immigration Processing Status seemed to be redundant. VJ – did you get a chance to check what is the current source for “Employee on Visa” and which app uses it?', '', 'VJ/Sameer', 0, '2018-05-23', '2018-05-23'),
(116, 'Action Item', '"Emergency contact " "Emergency contact phone " source and usage ', '', 'Pratul', 0, '2018-05-23', '2018-05-23'),
(118, 'Action Item', 'Decision on timezone mapping', '', 'Rajni', 1, '2018-05-23', '2018-05-23'),
(119, 'Action Item', 'fields missing in mulesoft mapping: Job Billable	ws:Additional_Information/ws:Job_Billable   -  Supplier	ws:Additional_Information/ws:Supplier Termination Date', 'job billl get from job profile', 'Andrea', 1, '2018-05-23', '2018-05-23'),
(120, 'Action Item', 'Default filter s/b active true on list view for scoped HR ', '', 'Sameer', 0, '2018-05-24', '2018-05-24'),
(122, 'Action Item', 'Requirements around combining Workday admin/HR Admin roles', '', 'rajni', 0, '2018-05-28', '2018-05-24'),
(123, 'Action Item', 'Should Surf Admin have read access to Scoped HR P\'', '', 'Rajni', 0, '2018-05-25', '2018-05-25'),
(124, 'Accomplishment', 'Test Accom', NULL, NULL, 0, NULL, '2018-06-04'),
(125, 'Concern', 'Some concern', '', 'ansari', 0, NULL, '2018-06-04'),
(126, 'Accomplishment', 'Acc', NULL, NULL, 0, NULL, '2018-06-27'),
(127, 'Concern', 'Some concern', NULL, NULL, 0, NULL, '2018-06-27'),
(128, 'Decision', 'Some decision', NULL, NULL, 1, NULL, '2018-06-27'),
(129, 'Action Item', 'Some action item', NULL, 'Sadiya', 0, '2018-06-27', '2018-06-27'),
(130, 'Notes', 'Some notes here, some notes here', NULL, NULL, 0, NULL, '2018-06-27'),
(131, 'Notes', 'Some notes here, some notes here', NULL, NULL, 0, NULL, '2018-06-27'),
(132, 'Accomplishment', 'A', NULL, NULL, 0, NULL, '2018-06-27'),
(134, 'Decision', 'F', NULL, NULL, 1, NULL, '2018-06-27'),
(139, 'Decision', '3', NULL, NULL, 1, NULL, '2018-06-27'),
(142, 'Accomplishment', '1', NULL, NULL, 0, NULL, '2018-06-27'),
(143, 'Concern', '2', NULL, NULL, 0, NULL, '2018-06-27'),
(144, 'Decision', '3', NULL, NULL, 1, NULL, '2018-06-27'),
(145, 'Action Item', '5', NULL, '6', 0, '2018-06-27', '2018-06-27'),
(146, 'Notes', '4', NULL, NULL, 0, NULL, '2018-06-27'),
(147, 'Accomplishment', '1', NULL, NULL, 0, NULL, '2018-06-27'),
(148, 'Concern', '2', NULL, NULL, 0, NULL, '2018-06-27'),
(149, 'Decision', '3', NULL, NULL, 1, NULL, '2018-06-27'),
(150, 'Action Item', '5', NULL, '6', 0, '2018-06-27', '2018-06-27'),
(151, 'Notes', '4', NULL, NULL, 0, NULL, '2018-06-27'),
(152, 'Accomplishment', 'acc', NULL, NULL, 0, NULL, '2018-06-27'),
(153, 'Action Item', 'Some action item', NULL, 'Sadiya', 0, '2018-06-28', '2018-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`) VALUES
(28, 'asaf', '8887400@gmail.com', '$2y$12$lGGq9bZIj7ZVyRIiGVbos.hoBiMG9AbI7SgTEqx2lkPvfedUewUh.', '3XiCy4U0BWoIuZB3dTpnpX-0eWLA3hDQ', 1522011824, NULL, NULL, '107.77.109.51', 1522011824, 1522011824, 0, NULL),
(30, 'M.A.', 'mohammad.asaf@servicenow.com', '$2y$12$K7rMLeZu/4vFNdHBaTC.7ej9vcWaOZO/n/08Rh1F/KLVAcPQmkRSe', '4odBnrQnCfL8pyLN-f2iiAsL0i3k3FS0', 1522785076, NULL, NULL, '70.34.50.20', 1522785044, 1522785044, 0, 1531057455),
(33, 'hamza_awan', 'saladinian@gmail.com', '$2y$12$hWqD3kDOmrVLDbI9T5OG4.TJYwe0irk35ksQQWvGWY2WzXmakkDCG', 'tTeHX2DHbA66_24qZQshVQ6K3PJsTFnu', 1522935268, NULL, NULL, '119.153.164.146', 1522935268, 1522935268, 0, NULL),
(35, 'Afdal', 'afzal441@gmail.com', '$2y$12$L9XG7VDjs/BltzfHv1YSgupPDnPShJFf2HhenT1ltRZVIQi49GWZe', '3vVzv_OZM66aOwPOt6TsWwpQ4V-NlU0N', 1523296879, NULL, NULL, '99.203.11.253', 1523296879, 1523296879, 0, NULL),
(36, 'Waqas390', 'waqasa3900@gmail.com', '$2y$12$Y0GpBcEby/OvLnO2NkWQ2O6lt9LRFuWcb.zeL9m.wDiswLSXhDbdW', 'JQBB454cMGi_Yl0s4FMaxs0dhyqGOWFM', 1524025612, NULL, NULL, '24.7.181.160', 1524025612, 1524025612, 0, NULL),
(37, 'faisal', 'faysalali534@gmail.com', '$2y$12$wh/CB6EyDfa2dr6i0iK06OesUPEz3.o5kYhYGnML76BD75yeqaU4O', 'GlgEwaL9wm_8lPEMSZ_dujFWM3VxbBfL', 1524051869, NULL, NULL, '116.58.41.148', 1524051869, 1524051869, 0, NULL),
(39, 'Safa', 'purple.safa@gmail.com', '$2y$12$Ims8C9wxVdKZ/fi6eZn78uz/9zrM9tO7s.eJO.OI1Qf2RWclMsmFu', 'YiR1UaCkpoo2DaYv1MD-Rh91wZNjXj70', 1524421019, NULL, NULL, '69.181.163.59', 1524421019, 1524421019, 0, NULL),
(47, 'Anonymous975478981', 'l144210@lhr.nu.edu.pk', '$2y$12$fsuA5CFQmZ1ak9gMHw/WGeC0OPJHaDd0u5P8NG3ZgEHA.m/w.GyB2', '1I_OC7l7OcaUM5RfEkgX8Z9Csticd7bI', NULL, NULL, NULL, '119.153.212.220', 1524443928, 1524444892, 0, 1526640663),
(48, 'ssshaikh', 'ssshaikh@gmail.com', '$2y$12$ULMQzHv.lTn7hXu5pANq.O0Cn9y8ulW1le7.8onnVHI66uzPoKVi2', 'aoh01RQzEQ-nYDLiQ1fyxnhXmWlU4OSm', 1524452490, NULL, NULL, '107.77.109.47', 1524452490, 1524452490, 0, NULL),
(49, 'Anonymous2069007577', 'rajni.bajpai@servicenow.com', '$2y$12$YrgJBeySaf5Eqtm076g4Fu29WUhhJIUugsf0JO4HtpG4Y6L2B1tj6', 'bilVTXi80d45vrVuWniFLTTCgIj2QV_T', NULL, NULL, NULL, '70.34.50.20', 1525216264, 1525216294, 0, NULL),
(50, 'sadiyafarheen', 'fw.ansaris@gmail.com', '$2y$12$9dkMsCmBltJFb1IJUbQ94eWKiyIbFX6S8P3i9.nAButT8tX9V.xK6', 'IIXoxARcj56kvFJSIrMS6B0faPbtznUg', 1526893162, NULL, NULL, '45.116.150.247', 1526893162, 1526893162, 0, NULL),
(52, 'sadiya', 'farheensadiya26@gmail.com', '$2y$12$K7rMLeZu/4vFNdHBaTC.7ej9vcWaOZO/n/08Rh1F/KLVAcPQmkRSe', 'c8YNh5Ingqw0yeZqO4DS76k-Orhc78mW', NULL, NULL, NULL, '127.0.0.1', 1528136257, 1528136257, 0, 1528136268);

-- --------------------------------------------------------

--
-- Table structure for table `user_category_permissions`
--

CREATE TABLE `user_category_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_allowed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_category_permissions`
--

INSERT INTO `user_category_permissions` (`id`, `user_id`, `category_id`, `is_allowed`) VALUES
(19, 28, 20, 1),
(20, 28, 21, 1),
(23, 28, 23, 1),
(24, 30, 24, 1),
(28, 33, 27, 1),
(31, 28, 29, 1),
(32, 35, 30, 1),
(33, 30, 31, 1),
(34, 28, 32, 1),
(35, 30, 33, 1),
(36, 33, 20, 1),
(37, 28, 34, 1),
(39, 39, 36, 1),
(47, 47, 27, 1),
(48, 30, 37, 1),
(49, 28, 38, 1),
(50, 49, 33, 1),
(51, 30, 39, 1),
(52, 28, 40, 1),
(53, 30, 41, 1),
(54, 30, 42, 1),
(55, 30, 43, 1),
(56, 50, 38, 1),
(57, 52, 44, 1);

-- --------------------------------------------------------

--
-- Table structure for table `view_permission_urls`
--

CREATE TABLE `view_permission_urls` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `view_permission_urls`
--

INSERT INTO `view_permission_urls` (`id`, `user_id`, `category_id`, `url`) VALUES
(15, 28, 20, '1522011833904840293'),
(16, 28, 21, '152201198039390253'),
(18, 28, 23, '15220505661202514707'),
(19, 30, 24, '15227853021509095808'),
(22, 33, 27, '15229353421683727620'),
(24, 28, 29, '1523082527404168765'),
(25, 35, 30, '15233963772118137722'),
(26, 30, 31, '152346424252210697'),
(27, 28, 32, '15239417411584318331'),
(28, 30, 33, '1524194094932513554'),
(29, 28, 34, '1524387345373742357'),
(31, 39, 36, '1524421192402776141'),
(32, 30, 37, '15245470841686367007'),
(33, 28, 38, '1524886490422679940'),
(34, 30, 39, '15258149041686285218'),
(35, 28, 40, '1526018884539170193'),
(36, 30, 41, '15263415201104028431'),
(37, 30, 42, '1526341539427760220'),
(38, 30, 43, '1526690699992757853'),
(39, 52, 44, '1528136330645147885');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category_updates`
--
ALTER TABLE `category_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `update_id` (`update_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `project_id` (`project_id`) USING BTREE;

--
-- Indexes for table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`category_id`,`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `project_updates`
--
ALTER TABLE `project_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `update_id` (`update_id`);

--
-- Indexes for table `pulse`
--
ALTER TABLE `pulse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_username` (`username`),
  ADD UNIQUE KEY `user_unique_email` (`email`);

--
-- Indexes for table `user_category_permissions`
--
ALTER TABLE `user_category_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `view_permission_urls`
--
ALTER TABLE `view_permission_urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `category_updates`
--
ALTER TABLE `category_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=976;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;
--
-- AUTO_INCREMENT for table `project_updates`
--
ALTER TABLE `project_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `pulse`
--
ALTER TABLE `pulse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `user_category_permissions`
--
ALTER TABLE `user_category_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `view_permission_urls`
--
ALTER TABLE `view_permission_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD CONSTRAINT `custom_fields_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `custom_fields_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discussions`
--
ALTER TABLE `discussions`
  ADD CONSTRAINT `discussions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discussions_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_updates`
--
ALTER TABLE `project_updates`
  ADD CONSTRAINT `project_updates_ibfk_1` FOREIGN KEY (`update_id`) REFERENCES `updates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_updates_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_updates_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_category_permissions`
--
ALTER TABLE `user_category_permissions`
  ADD CONSTRAINT `user_category_permissions_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_category_permissions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `view_permission_urls`
--
ALTER TABLE `view_permission_urls`
  ADD CONSTRAINT `view_permission_urls_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `view_permission_urls_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
