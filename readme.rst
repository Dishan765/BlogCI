#Story
A website where users can:
	-register
	-login
	-post stories 
	-update their story
	-delete their story
	-view story by category
The story website was built using the Codeigniter framework.

#What I Learned
Learn the  MVC design pattern.
Learned about routing, authentication and sessions in Codeigniter framework.


#Usage

##SQL
CREATE TABLE `Posts` (
  `PostID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Content` text NOT NULL,
  `Category` varchar(30) DEFAULT 'Misc',
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp(),
   PRIMARY KEY (PostID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `User` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Image` varchar(40) NOT NULL,
   PRIMARY KEY (`UserID`);
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `Posts`
  ADD CONSTRAINT `Posts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`);






