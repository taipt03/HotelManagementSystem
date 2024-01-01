BEGIN;
SET TIME ZONE '+00:00';
--
--
CREATE TABLE tbladmin (
  ID SERIAL NOT NULL PRIMARY KEY,
  AdminName varchar(120) DEFAULT NULL,
  UserName varchar(200) DEFAULT NULL,
  MobileNumber bigint DEFAULT NULL,
  Email varchar(200) DEFAULT NULL,
  Password varchar(200) DEFAULT NULL,
  AdminRegdate timestamp(0) NULL DEFAULT current_timestamp
) ;


--
-- SQLINES DEMO *** table `tbladmin`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO tbladmin (ID, AdminName, UserName, MobileNumber, Email, Password, AdminRegdate) VALUES
(1, 'Admin', 'admin', 5689784592, 'admin@gmail.com', '123456789', '2023-07-01 07:25:30');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** or table `tblbooking`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE tblbooking (
  ID SERIAL NOT NULL PRIMARY KEY,
  RoomId int DEFAULT NULL,
  BookingNumber varchar(120) DEFAULT NULL,
  PaymentMethod varchar (100) DEFAULT NULL,
  UserID int NOT NULL,
  CheckinDate varchar(200) DEFAULT NULL,
  CheckoutDate varchar(200) DEFAULT NULL,
  BookingDate timestamp(0) NULL DEFAULT current_timestamp,
  Remark varchar(50) DEFAULT NULL,
  Status varchar(50) DEFAULT NULL,
  UpdationDate timestamp(0) NULL DEFAULT NULL /* ON UPDATE current_timestamp() */
) ;

--
-- SQLINES DEMO *** table `tblbooking`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO tblbooking (ID, RoomId, BookingNumber, PaymentMethod, UserID, CheckinDate, CheckoutDate, BookingDate, Remark, Status, UpdationDate) VALUES
(1, 1, '390343987', 'Identification Card',1, '2023-05-10', '2023-05-15', '2023-05-02 07:12:29', 'Booking accepted', 'Approved', '2023-05-02 07:15:51');
-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** or table `tblcategory`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE tblcategory (
  ID SERIAL NOT NULL PRIMARY KEY,
  CategoryName varchar(120) DEFAULT NULL,
  Description TEXT DEFAULT NULL,
  Date timestamp(0) NULL DEFAULT current_timestamp
) ;

--
-- SQLINES DEMO *** table `tblcategory`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO tblcategory (ID, CategoryName, Description, Date) VALUES
(1, 'Single Room', 'Only for one person', '2023-02-23 06:43:55'),
(2, 'Double Room', 'For Two Person', '2023-03-23 06:44:55');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** or table `tblcontact`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE tblcontact (
  ID SERIAL NOT NULL PRIMARY KEY,
  UserID int NOT NULL,
  Message TEXT DEFAULT NULL,
  EnquiryDate timestamp(0) NULL DEFAULT current_timestamp,
  IsRead int DEFAULT NULL
) ;

--
-- SQLINES DEMO *** table `tblcontact`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO tblcontact (ID, UserID, Message, EnquiryDate, IsRead) VALUES
(1, 1, 'I want o stay in hotel', '2023-08-05 02:53:52', 1);

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** or table `tblfacility`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE tblfacility (
  --ID SERIAL int(10) PRIMARY KEY
  ID SERIAL NOT NULL PRIMARY KEY,
  FacilityTitle varchar(200) DEFAULT NULL,
  Description TEXT DEFAULT NULL,
  Image varchar(200) DEFAULT NULL,
  CreationDate timestamp(0) NULL DEFAULT current_timestamp
) ;

--
-- SQLINES DEMO *** table `tblfacility`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO tblfacility (ID, FacilityTitle, Description, Image, CreationDate) VALUES
(1, '24-Hour room service', '24-Hour room service available', 'b9fb9d37bdf15a699bc071ce49baea531582890659.jpg', '2023-04-29 11:54:05'),
(2, 'Free wireless internet access', 'Free wireless internet access available in room restro area', '7fdc1a630c238af0815181f9faa190f51582890845.jpg', '2023-04-29 11:54:05'),
(3, 'Laundry service', 'Free Laundry service for a customer in queen and king size room', '3c7baecb174a0cbcc64507e9c3308c4b1582890987.jpg', '2023-04-29 11:54:05'),
(4, 'Tour & excursions', 'vehicle are available for tour and travels', '1e6ae4ada992769567b71815f124fac51582891174.jpg', '2023-04-29 11:54:05'),
(5, 'Airport transfers', 'Airport transfers facility available on demand', 'c9e82378a39eec108727a123b09056651582891272.jpg', '2023-04-29 11:54:05'),
(6, 'Babysitting on request', 'Babysitting on request', 'c26be60cfd1ba40772b5ac48b95ab19b1582891331.png', '2023-04-29 11:54:05'),
(7, '24-Hour doctor on call', '24-Hour doctor on call', '55ccf27d26d7b23839986b6ae2e447ab1582891425.jpg', '2023-04-29 11:54:05'),
(8, 'Meeting facilities', 'Meeting facilities available for company person', 'efc1a80c391be252d7d777a437f868701582891713.jpg', '2023-04-29 11:54:05');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** or table `tblpage`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE tblpage (
  --ID SERIAL int(10) PRIMARY KEY
  ID SERIAL NOT NULL PRIMARY KEY,
  PageType varchar(120) DEFAULT NULL,
  PageTitle varchar(200) DEFAULT NULL,
  PageDescription TEXT DEFAULT NULL,
  Email varchar(120) DEFAULT NULL,
  MobileNumber bigint DEFAULT NULL,
  UpdationDate timestamp(0) NULL DEFAULT NULL /* ON UPDATE current_timestamp() */
) ;

--
-- SQLINES DEMO *** table `tblpage`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO tblpage (ID, PageType, PageTitle, PageDescription, Email, MobileNumber, UpdationDate) VALUES
(1, 'aboutus', 'About Us', 'We have 72 comfortably equipped rooms, including two suites: The President Suite and the Ambassador Suite, with over one hundred metres of surface area, which are sure to awe even the most demanding Guests. We offer 7 rooms, where we have been preparing family and business meetings already for 15 years.', NULL, NULL, NULL),
(2, 'contactus', 'Contact Us', '1st, Dai Co Viet St., Hai Ba Trung, Ha Noi, Viet nam', 'info@gmail.com', 0123456789, '2023-06-30 19:30:00');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** or table `tblroom`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE tblroom (
  --ID SERIAL int(10) PRIMARY KEY
  ID SERIAL NOT NULL PRIMARY KEY  ,
  RoomType int DEFAULT NULL,
  RoomName varchar(200) DEFAULT NULL,
  MaxAdult int DEFAULT NULL,
  MaxChild int DEFAULT NULL,
  RoomDesc TEXT DEFAULT NULL,
  NoofBed int DEFAULT NULL,
  Image varchar(200) DEFAULT NULL,
  RoomFacility varchar(200) DEFAULT NULL,
  CreationDate timestamp(0) NULL DEFAULT current_timestamp,
  Price int DEFAULT NULL,
  Quantity int DEFAULT NULL
) ;

--
-- SQLINES DEMO *** table `tblroom`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO tblroom (ID, RoomType, RoomName, MaxAdult, MaxChild, RoomDesc, NoofBed, Image, RoomFacility, CreationDate, Price, Quantity) VALUES
(1, 1, 'Single Room for one person', 1, 2, 'A single room is for one person and contains a single bed, and will usually be quite small', 1, '2870b3543f2550c16a4551f03a0b84ac1582975994.jpg', '24-Hour room service,Free wireless internet acces', '2023-04-29 11:33:14',800,4),
(2, 2, 'Double Room', 2, 2, 'A double room is a room intended for two people, usually a couple, to stay in. One person occupying a double room has to pay a supplement.', 2, '74375080377499ab76dad37484ee7f151582982180.jpg', '24-Hour room service,Free wireless internet acces', '2023-04-29 11:33:14',1200,3),
(3, 3, 'triple room', 4, 2, 'A triple room is a hotel room that is made to comfortably accommodate three people. The triple room , simply called a triple, at times, may be configured with different bed sizes to ensure three hotel guests can be accommodated comfortably.', 3, '5ebc75f329d3b6f84d44c2c2e9764d4f1582976638.jpg', '24-Hour room service,Free wireless internet access,Laundry service,Babysitting on request,24-Hour doctor on call,Meeting facilities', '2023-04-29 11:33:14',1500,1);


-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** or table `tbluser`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE tbluser (
  ID SERIAL NOT NULL PRIMARY KEY,
  --ID SERIAL int(10) PRIMARY KEY
  FullName varchar(200) DEFAULT NULL,
  MobileNumber bigint DEFAULT NULL,
  Email varchar(120) DEFAULT NULL,
  Password varchar(120) DEFAULT NULL,
  RegDate timestamp(0) NULL DEFAULT current_timestamp,
  IDType varchar(50) DEFAULT NULL,
  Gender varchar(1) DEFAULT NULL,
  Address varchar(100) DEFAULT NULL
) ;

--
-- SQLINES DEMO *** table `tbluser`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO tbluser (ID, FullName, MobileNumber, Email, Password, RegDate,IDType, Gender, Address) VALUES
(1, 'Test', 7897897899, 'test@gmail.com', '202cb962ac59075b964b07152d234b70', '2023-07-24 17:07:28','passport', 'M','1 Dai Co Viet'),
(2, 'Sample', 4644654646, 'sample@gmail.com', '202cb962ac59075b964b07152d234b70', '2023-07-30 12:51:42', 'ID card', 'F', ' 2 Dai Co Viet');

--
-- SQLINES DEMO *** r table `tbladmin`
--
CREATE TABLE tblpayment (
  ID SERIAL NOT NULL PRIMARY KEY,
  --ID SERIAL int(10) PRIMARY KEY
  UserID int NOT NULL,
  RoomID int NOT NULL,
  FromDate TIMESTAMP(0) NULL DEFAULT CURRENT_TIMESTAMP,
  ToDAte TIMESTAMP(0) NULL DEFAULT CURRENT_TIMESTAMP,
  TotalPrice INT DEFAULT NULL
) ;

COMMIT;

/* SQLINES DEMO *** ER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/* SQLINES DEMO *** ER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/* SQLINES DEMO *** ON_CONNECTION=@OLD_COLLATION_CONNECTION */;
