
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE TABLE tbladmin (
  ID INT NOT NULL,
  AdminName VARCHAR(120) DEFAULT NULL,
  UserName VARCHAR(200) DEFAULT NULL,
  MobileNumber BIGINT DEFAULT NULL,
  Email VARCHAR(200) DEFAULT NULL,
  Password VARCHAR(200) DEFAULT NULL,
  AdminRegdate TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (ID)
);

INSERT INTO "tbladmin" ("ID", "AdminName", "UserName", "MobileNumber", "Email", "Password", "AdminRegdate")
VALUES (1, 'Admin', 'admin', 5689784592, 'admin@gmail.com', '123456789', '2023-07-01 07:25:30');

CREATE TABLE "tblbooking" (
"ID" INT NOT NULL,
"RoomId" INT DEFAULT NULL,
"BookingNumber" VARCHAR(120) DEFAULT NULL,
"UserID" INT NOT NULL,
"PaymentMethod" VARCHAR(120) DEFAULT NULL,
"Gender" VARCHAR(50) DEFAULT NULL,
"Address" TEXT DEFAULT NULL,
"CheckinDate" VARCHAR(200) DEFAULT NULL,
"CheckoutDate" VARCHAR(200) DEFAULT NULL,
"BookingDate" TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
"Remark" VARCHAR(50) DEFAULT NULL,
"Status" VARCHAR(50) DEFAULT NULL,
"UpdationDate" TIMESTAMP NULL DEFAULT NULL
);

-- CREATE OR REPLACE FUNCTION update_updation_date()
-- RETURNS TRIGGER AS $$
-- BEGIN
--   NEW.UpdationDate = CURRENT_TIMESTAMP;
--   RETURN NEW;
-- END;
-- $$ LANGUAGE plpgsql;

-- CREATE TRIGGER trg_update_updation_date
-- BEFORE UPDATE ON tblbooking
-- FOR EACH ROW
-- EXECUTE FUNCTION update_updation_date();

--
-- Dumping data for table `tblbooking`
--

INSERT INTO tblbooking ("id", "roomid", "bookingnumber", "userid", "paymentmethod", "checkindate", "checkoutdate", "bookingdate", "remark", "status", "updationdate") 
VALUES (2, 2, '545403040', 4, 'Visa Card', '2023-05-20', '2023-05-25', '2023-05-05 02:50:41', 'Booking Accepted', 'Approved', '2023-05-05 02:51:35');
CREATE TABLE "tblcategory" (
  "ID" INT NOT NULL,
  "CategoryName" VARCHAR(120) DEFAULT NULL,
  "Description" TEXT DEFAULT NULL,
  "Date" TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `CategoryName`, `Description`, `Date`) VALUES
(1, 'Single Room', 'Only for one person', '2023-02-23 06:43:55'),
(2, 'Double Room', 'For Two Person', '2023-03-23 06:44:55'),
(3, 'Triple Room', 'A room assigned to three people. May have two or more beds.', '2023-04-01 06:45:27'),
(4, 'Quad Room', 'A room assigned to four people. May have two or more beds.', '2020-02-28 06:45:56'),
(5, 'Queen Room', 'A room with a queen-sized bed. May be occupied by one or more people', '2023-05-01 06:46:30');



CREATE TABLE "tblcontact" (
  "ID" INT NOT NULL,
  "UserID" INT,
  "Message" TEXT DEFAULT NULL,
  "EnquiryTime" TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  "IsRead" INT DEFAULT NULL
);
--
-- Dumping data for table `tblcontact`
--

INSERT INTO "tblcontact" ("ID", "UserID", "Message", "EnquiryTime", "IsRead")
VALUES (1, 1, 'I want to stay in hotel', '2023-08-05 02:53:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblfacility`
--

CREATE TABLE "tblfacility" (
  "ID" INT NOT NULL,
  "FacilityTitle" VARCHAR(200) DEFAULT NULL,
  "Description" TEXT DEFAULT NULL,
  "Image" VARCHAR(200) DEFAULT NULL,
  "CreationDate" TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `tblfacility`
--

INSERT INTO "tblfacility" ("ID", "FacilityTitle", "Description", "Image", "CreationDate")
VALUES
(1, '24-Hour room service', '24-Hour room service available', 'b9fb9d37bdf15a699bc071ce49baea531582890659.jpg', '2023-04-29 11:54:05'),
(2, 'Free wireless internet access', 'Free wireless internet access available in room restro area', '7fdc1a630c238af0815181f9faa190f51582890845.jpg', '2023-04-29 11:54:05'),
(3, 'Laundry service', 'Free Laundry service for a customer in queen and king size room', '3c7baecb174a0cbcc64507e9c3308c4b1582890987.jpg', '2023-04-29 11:54:05'),
(4, 'Tour & excursions', 'vehicle are available for tour and travels', '1e6ae4ada992769567b71815f124fac51582891174.jpg', '2023-04-29 11:54:05'),
(5, 'Airport transfers', 'Airport transfers facility available on demand', 'c9e82378a39eec108727a123b09056651582891272.jpg', '2023-04-29 11:54:05'),
(6, 'Babysitting on request', 'Babysitting on request', 'c26be60cfd1ba40772b5ac48b95ab19b1582891331.png', '2023-04-29 11:54:05'),
(7, '24-Hour doctor on call', '24-Hour doctor on call', '55ccf27d26d7b23839986b6ae2e447ab1582891425.jpg', '2023-04-29 11:54:05'),
(8, 'Meeting facilities', 'Meeting facilities available for company person', 'efc1a80c391be252d7d777a437f868701582891713.jpg', '2023-04-29 11:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE "tblpage" (
  "ID" INT NOT NULL,
  "PageType" VARCHAR(120) DEFAULT NULL,
  "PageTitle" VARCHAR(200) DEFAULT NULL,
  "PageDescription" TEXT DEFAULT NULL,
  "Email" VARCHAR(120) DEFAULT NULL,
  "MobileNumber" BIGINT DEFAULT NULL,
  "UpdationDate" TIMESTAMP NULL DEFAULT NULL
) ;

--
-- Dumping data for table `tblpage`
--

INSERT INTO "tblpage" ("ID", "PageType", "PageTitle", "PageDescription", "Email", "MobileNumber", "UpdationDate")
VALUES
(1, 'aboutus', 'About Us', 'We have 72 comfortably equipped rooms, including two suites: The President Suite and the Ambassador Suite, with over one hundred metres of surface area, which are sure to awe even the most demanding Guests. We offer 7 rooms, where we have been preparing family and business meetings already for 15 years.', NULL, NULL, NULL),
(2, 'contactus', 'Contact Us', '1st, Dai Co Viet St., Hai Ba Trung, Ha Noi, Viet nam', 'info@gmail.com', 0123456789, '2023-06-30 19:30:00');
-- --------------------------------------------------------

--
-- Table structure for table `tblroom`
--

CREATE TABLE "tblroom" (
  "ID" int NOT NULL,
  "RoomType" int DEFAULT NULL,
  "RoomName" varchar(200) DEFAULT NULL,
  "MaxAdult" int DEFAULT NULL,
  "MaxChild" int DEFAULT NULL,
  "RoomDesc" text DEFAULT NULL,
  "NoofBed" int DEFAULT NULL,
  "Image" varchar(200) DEFAULT NULL,
  "RoomFacility" varchar(200) DEFAULT NULL,
  "CreationDate" timestamp DEFAULT CURRENT_TIMESTAMP,
  "Price" int DEFAULT NULL,
  "Quantity" int DEFAULT NULL
);

--
-- Dumping data for table `tblroom`
--

INSERT INTO "tblroom" ("ID", "RoomType", "RoomName", "MaxAdult", "MaxChild", "RoomDesc", "NoofBed", "Image", "RoomFacility", "CreationDate", "Price", "Quantity")
VALUES (1, 1, 'Single Room for one person', 1, 2, 'A single room is for one person and contains a single bed, and will usually be quite small', 1, '2870b3543f2550c16a4551f03a0b84ac1582975994.jpg', '24-Hour room service,Free wireless internet acces', '2023-04-29 11:33:14', 800, 4);


-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE "tbluser" (
  "ID" int NOT NULL,
  "FullName" varchar(200) DEFAULT NULL,
  "MobileNumber" varchar(10) DEFAULT NULL,
  "Email" varchar(120) DEFAULT NULL,
  "Password" varchar(120) DEFAULT NULL,
  "RegDate" timestamp NULL DEFAULT current_timestamp,
  "IDType" varchar(50),
  "Gender" varchar(1),
  "Address" varchar(100)
) ;

--
-- Dumping data for table `tbluser`
--

INSERT INTO "tbluser" ("ID", "FullName", "MobileNumber", "Email", "Password", "RegDate", "IDType", "Gender", "Address")
VALUES (1, 'Test', 7897897899, 'test@gmail.com', '202cb962ac59075b964b07152d234b70', '2023-07-24 17:07:28', '389216598638JK', 'M', '1 Dai Co Viet');
--
-- Indexes for dumped tables
--

--
--
-- Indexes for table `tblbooking`


ALTER TABLE "tblbooking"
  ADD PRIMARY KEY ("ID");

ALTER TABLE "tblcategory"
  ADD PRIMARY KEY ("ID");

ALTER TABLE "tblcontact"
  ADD PRIMARY KEY ("ID");

ALTER TABLE "tblfacility"
  ADD PRIMARY KEY ("ID");

ALTER TABLE "tblpage"
  ADD PRIMARY KEY ("ID");

ALTER TABLE "tblroom"
  ADD PRIMARY KEY ("ID");

ALTER TABLE "tbluser"
  ADD PRIMARY KEY ("ID");

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE "tbladmin"
  ALTER COLUMN "ID" SET DATA TYPE INT,
  ALTER COLUMN "ID" SET NOT NULL,
  ALTER COLUMN "ID" ADD GENERATED ALWAYS AS IDENTITY (START WITH 2);

ALTER TABLE "tblbooking"
  ALTER COLUMN "ID" SET DATA TYPE INT,
  ALTER COLUMN "ID" SET NOT NULL,
  ALTER COLUMN "ID" ADD GENERATED ALWAYS AS IDENTITY (START WITH 3);

ALTER TABLE "tblcategory"
  ALTER COLUMN "ID" SET DATA TYPE INT,
  ALTER COLUMN "ID" SET NOT NULL,
  ALTER COLUMN "ID" ADD GENERATED ALWAYS AS IDENTITY (START WITH 8);

ALTER TABLE "tblcontact"
  ALTER COLUMN "ID" SET DATA TYPE INT,
  ALTER COLUMN "ID" SET NOT NULL,
  ALTER COLUMN "ID" ADD GENERATED ALWAYS AS IDENTITY (START WITH 2);

ALTER TABLE "tblfacility"
  ALTER COLUMN "ID" SET DATA TYPE INT,
  ALTER COLUMN "ID" SET NOT NULL,
  ALTER COLUMN "ID" ADD GENERATED ALWAYS AS IDENTITY (START WITH 10);

ALTER TABLE "tblpage"
  ALTER COLUMN "ID" SET DATA TYPE INT,
  ALTER COLUMN "ID" SET NOT NULL,
  ALTER COLUMN "ID" ADD GENERATED ALWAYS AS IDENTITY (START WITH 3);

ALTER TABLE "tblroom"
  ALTER COLUMN "ID" SET DATA TYPE INT,
  ALTER COLUMN "ID" SET NOT NULL,
  ALTER COLUMN "ID" ADD GENERATED ALWAYS AS IDENTITY (START WITH 9);

ALTER TABLE "tbluser"
  ALTER COLUMN "ID" SET DATA TYPE INT,
  ALTER COLUMN "ID" SET NOT NULL,
  ALTER COLUMN "ID" ADD GENERATED ALWAYS AS IDENTITY (START WITH 5);
