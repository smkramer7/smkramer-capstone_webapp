CREATE TABLE team(
	TeamID int AUTO_INCREMENT,
	PRIMARY KEY (TeamID))
ENGINE INNODB; 

CREATE TABLE sprint(
	SprintID int AUTO_INCREMENT,
	start_date date NOT NULL,
	end_date date NOT NULL,
	PRIMARY KEY (SprintID))
ENGINE INNODB; 


CREATE TABLE meeting(
	MeetingID int AUTO_INCREMENT,
	meeting_time time NOT NULL,
	meeting_date date NOT NULL,
	team_attendance varchar(10),
	teamID INT NOT NULL,
	sprintID INT NOT NULL,
	PRIMARY KEY (MeetingID),
FOREIGN KEY (teamID) REFERENCES team(TeamID),
FOREIGN KEY (sprintID) REFERENCES sprint(SprintID))
ENGINE INNODB;

CREATE TABLE student(
	StudentID int AUTO_INCREMENT,
	first_name varchar(25) NOT NULL,
	middle_name varchar(25),
	last_name varchar(25) NOT NULL,
	email varchar(25) NOT NULL,
	phone varchar(25),
	teamID INT NOT NULL,
	PRIMARY KEY (StudentID),
	FOREIGN KEY (teamID) REFERENCES team(TeamID))
ENGINE=INNODB;

CREATE TABLE note(
	NoteID int AUTO_INCREMENT,
	title varchar(25),
	content varchar(500) NOT NULL,
	meetingID INT NOT NULL,
	PRIMARY KEY (NoteID),
	FOREIGN KEY (meetingID) REFERENCES meeting(MeetingID))
ENGINE INNODB; 

CREATE TABLE task(
	TaskID int AUTO_INCREMENT,
	title varchar(25),
	content varchar(500) NOT NULL,
	assigned_date date NOT NULL,
	due_date date,
	completion_date date,
	meetingID INT NOT NULL,
	teamID INT NOT NULL,
	PRIMARY KEY (TaskID),
	FOREIGN KEY (meetingID) REFERENCES meeting(MeetingID),
	FOREIGN KEY (teamID) REFERENCES team(TeamID))
ENGINE INNODB; 

CREATE TABLE rating(
	RatingID int AUTO_INCREMENT,
	rating_name varchar(25),
	lowest_rank int,
	highest_rank int,
	PRIMARY KEY (RatingID))
ENGINE INNODB; 

CREATE TABLE student_attendance(
	attendance varchar(11) NOT NULL,
	studentID INT NOT NULL,
	meetingID INT NOT NULL,
	FOREIGN KEY (studentID) REFERENCES student(StudentID),
	FOREIGN KEY (meetingID) REFERENCES meeting(MeetingID))
ENGINE =INNODB;

CREATE TABLE meeting_rating(
	value INT NOT NULL,
	ratingID INT NOT NULL,
	meetingID INT NOT NULL,
	FOREIGN KEY (ratingID) REFERENCES rating(RatingID),
	FOREIGN KEY (meetingID) REFERENCES meeting(MeetingID))
ENGINE =INNODB;


CREATE TABLE meeting(
	MeetingID int AUTO_INCREMENT,
	meeting_time time NOT NULL,
	meeting_date date NOT NULL,
	team_attendance varchar(10),
	teamID INT NOT NULL,
	sprintID INT NOT NULL,
	PRIMARY KEY (MeetingID),
FOREIGN KEY (teamID) REFERENCES team(TeamID),
FOREIGN KEY (sprintID) REFERENCES sprint(SprintID))
ENGINE INNODB;

CREATE TABLE availability(
	aID int AUTO_INCREMENT,
	sprintID INT NOT NULL,
	adate date NOT NULL,
	start_time time NOT NULL,
	end_time time NOT NULL,
	PRIMARY KEY (aID),
FOREIGN KEY (sprintID) REFERENCES sprint(SprintID))
ENGINE INNODB;

/*! Select Meeting */
Select mt.meeting_time, mt.meeting_date, mt.teamID, mt.MeetingID
from meeting as mt ORDER BY MeetingID desc;

/*! Select Student/Attendance */
Select s.first_name, s.last_name, sa.attendance
from meeting as mt, student as s, student_attendance as sa
where mt.teamID = s.teamID and sa.meetingID = mt.MeetingID and sa.studentID = s.StudentID
and mt.MeetingID = 1;

/*! Select Meeting Rating */
Select r.rating_name, mr.value
from rating as r, meeting_rating as mr
where r.RatingID = mr.ratingID and mr.meetingID = 1;

/*! Select Notes */
Select content 
from note 
where meetingID = 1;

/*! Select Tasks */
Select content
from task
where meetingID = 1;

/*! Select Team query */
Select TeamID
from team;

/*! Select Sprint query */
Select SprintID
from sprint;

INSERT INTO sprint (SprintID, start_date, end_date) VALUES (1,'2018-08-20', '2018-08-28'); 
INSERT INTO sprint (SprintID, start_date, end_date) VALUES (2,'2018-08-28', '2018-09-05'); 
INSERT INTO sprint (SprintID, start_date, end_date) VALUES (3,'2018-09-05', '2019-09-12');

INSERT INTO team (TeamID) VALUES (1); 
INSERT INTO team (TeamID) VALUES (2); 
INSERT INTO team (TeamID) VALUES (3); 

INSERT INTO student (StudentID, first_name, last_name, email, teamID) VALUES (1, 'Jon', 'Snow', 'jonsnow@gmail.com', 1); 
INSERT INTO student (StudentID, first_name, last_name, email, teamID) VALUES (2, 'Sansa', 'Stark', 'sansastark@gmail.com', 1); 
INSERT INTO student (StudentID, first_name, last_name, email, teamID) VALUES (3, 'Arya', 'Stark', 'aryastark@gmail.com', 1) ;
INSERT INTO student (StudentID, first_name, last_name, email, teamID) VALUES (4, 'Tyrion', 'Lannister', 'tlannister@gmail.com', 2) ;
INSERT INTO student (StudentID, first_name, last_name, email, teamID) VALUES (5, 'Tywin', 'Lannister', 'tywin@gmail.com', 2) ;
INSERT INTO student (StudentID, first_name, last_name, email, teamID) VALUES (6, 'Cercei', 'Lannister', 'cerceil@gmail.com', 2); 

INSERT INTO meeting (MeetingID, meeting_time, meeting_date, teamID, sprintID) VALUES (1, '15:00:00', '2018-08-21',1,1); 
INSERT INTO meeting (MeetingID, meeting_time, meeting_date, teamID, sprintID) VALUES (2, '16:00:00', '2018-08-22',2,1);
INSERT INTO meeting (MeetingID, meeting_time, meeting_date, teamID, sprintID) VALUES (3, '14:00:00', '2018-08-29',1,2);
  
INSERT INTO student_attendance (attendance, studentID, meetingID) VALUES ('Present', 1, 1);
INSERT INTO student_attendance (attendance, studentID, meetingID) VALUES ('Missed', 2, 1);
INSERT INTO student_attendance (attendance, studentID, meetingID) VALUES ('Late', 3, 1);

INSERT INTO student_attendance (attendance, studentID, meetingID) VALUES ('Present', 4, 2);
INSERT INTO student_attendance (attendance, studentID, meetingID) VALUES ('Present', 5, 2);
INSERT INTO student_attendance (attendance, studentID, meetingID) VALUES ('Present', 6, 2);

INSERT INTO student_attendance (attendance, studentID, meetingID) VALUES ('Missed', 1, 3);
INSERT INTO student_attendance (attendance, studentID, meetingID) VALUES ('Missed', 2, 3);
INSERT INTO student_attendance (attendance, studentID, meetingID) VALUES ('Missed', 3, 3);

INSERT INTO rating (RatingID, rating_name, lowest_rank, highest_rank) VALUES (1, 'Process', 1, 5);
INSERT INTO rating (RatingID, rating_name, lowest_rank, highest_rank) VALUES (2, 'Design', 1, 5);
INSERT INTO rating (RatingID, rating_name, lowest_rank, highest_rank) VALUES (3, 'Overall', 1, 5);

INSERT INTO meeting_rating (value, ratingID, meetingID) VALUES (1, 1, 1);
INSERT INTO meeting_rating (value, ratingID, meetingID) VALUES (5, 2, 1);
INSERT INTO meeting_rating (value, ratingID, meetingID) VALUES (1, 3, 1);

INSERT INTO meeting_rating (value, ratingID, meetingID) VALUES (3, 1, 2);
INSERT INTO meeting_rating (value, ratingID, meetingID) VALUES (3, 2, 2);
INSERT INTO meeting_rating (value, ratingID, meetingID) VALUES (3, 3, 2);

INSERT INTO meeting_rating (value, ratingID, meetingID) VALUES (5, 1, 3);
INSERT INTO meeting_rating (value, ratingID, meetingID) VALUES (2, 2, 3);
INSERT INTO meeting_rating (value, ratingID, meetingID) VALUES (1, 3, 3);

INSERT INTO note (NoteID, content, meetingID) VALUES (1, 'Meeting went well', 1);
INSERT INTO note (NoteID, content, meetingID) VALUES (2, 'Meeting went poorly', 2);
INSERT INTO note (NoteID, content, meetingID) VALUES (3, 'Meeting was okay', 3);
INSERT INTO note (NoteID, content, meetingID) VALUES (4, 'Team is ahead of schedule', 1);

INSERT INTO task (TaskID, content, assigned_date, completion_date, meetingID, teamID) VALUES (1, 'Complete SQL query', '2018-08-21', '2018-08-29', 1, 1);
INSERT INTO task (TaskID, content, assigned_date, meetingID, teamID) VALUES (2, 'Complete Frontend of website', '2018-08-21', 1, 1);
INSERT INTO task (TaskID, content, assigned_date, meetingID, teamID) VALUES (3, 'Complete SQL query', '2018-08-22', 2, 2);
INSERT INTO task (TaskID, content, assigned_date, meetingID, teamID) VALUES (4, 'Do the ERD', '2018-08-29', 3, 1);

INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (1, 1, '2018-08-20', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (2, 1, '2018-08-21', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (3, 1, '2018-08-22', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (4, 1, '2018-08-23', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (5, 1, '2018-08-24', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (6, 1, '2018-08-27', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (7, 1, '2018-08-28', '09:00:00', '17:00:00');

INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (8, 2, '2018-08-29', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (9, 2, '2018-08-30', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (10, 2, '2018-08-31', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (11, 2, '2018-09-03', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (12, 2, '2018-09-04', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (13, 2, '2018-09-05', '09:00:00', '17:00:00');

INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (14, 3, '2018-09-06', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (15, 3, '2018-09-07', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (16, 3, '2018-09-08', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (17, 3, '2018-09-11', '09:00:00', '17:00:00');
INSERT INTO availability (aID, sprintID, adate, start_time, end_time) VALUES (18, 3, '2018-09-12', '09:00:00', '17:00:00');


INSERT INTO sprint (SprintID, start_date, end_date) VALUES (4,'2018-09-12', '2018-09-19');
INSERT INTO sprint (SprintID, start_date, end_date) VALUES (5,'2018-09-19', '2018-09-26');
INSERT INTO sprint (SprintID, start_date, end_date) VALUES (6,'2018-09-26', '2018-10-02');
INSERT INTO sprint (SprintID, start_date, end_date) VALUES (7,'2018-10-02', '2018-10-09');
INSERT INTO sprint (SprintID, start_date, end_date) VALUES (8,'2018-10-09', '2018-10-16');
INSERT INTO sprint (SprintID, start_date, end_date) VALUES (9,'2018-10-16', '2018-10-22');
INSERT INTO sprint (SprintID, start_date, end_date) VALUES (10,'2018-10-22', '2018-10-30');

INSERT INTO team (TeamID) VALUES (4); 
INSERT INTO team (TeamID) VALUES (5); 
INSERT INTO team (TeamID) VALUES (6); 

INSERT INTO meeting (MeetingID, meeting_time, meeting_date, teamID, sprintID) VALUES (4, '15:00:00', '2018-09-10',1,3); 
INSERT INTO meeting (MeetingID, meeting_time, meeting_date, teamID, sprintID) VALUES (5, '16:00:00', '2018-09-20',1,4);
INSERT INTO meeting (MeetingID, meeting_time, meeting_date, teamID, sprintID) VALUES (6, '14:00:00', '2018-09-25',1,5);
INSERT INTO meeting (MeetingID, meeting_time, meeting_date, teamID, sprintID) VALUES (7, '14:00:00', '2018-10-01',1,6);
INSERT INTO meeting (MeetingID, meeting_time, meeting_date, teamID, sprintID) VALUES (8, '14:00:00', '2018-10-05',1,7);

INSERT INTO meeting (MeetingID, meeting_time, meeting_date, teamID, sprintID) VALUES (9, '16:00:00', '2018-08-29',2,2);
INSERT INTO meeting (MeetingID, meeting_time, meeting_date, teamID, sprintID) VALUES (10, '16:00:00', '2018-09-04',2,3);







