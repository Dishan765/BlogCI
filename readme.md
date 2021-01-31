<h1>Story</h1>

A website where users can:
<ul>
  <li>Register</li>
  <li>Login</li>
  <li>Post stories</li>
  <li>Update their stories</li>
  <li>Delete their stories</li>
  <li>View a story by category</li>
</ul>
<p>The story website was built using the Codeigniter framework.</p>

<h1> What I Learned</h1>
<ul>
  <li>Learn the  MVC design pattern.</li>
  <li>Learned about routing, authentication and sessions in Codeigniter framework.</li>
</ul>


<h1>Usage</h1>

<h2>SQL</h2>

<pre>
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
   PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `Posts`
  ADD CONSTRAINT `Posts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`);
</pre>





