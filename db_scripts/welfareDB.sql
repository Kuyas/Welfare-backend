
CREATE TABLE android.USER (
	USER_ID INTEGER AUTO_INCREMENT PRIMARY KEY, 
	USER_MOBILE CHAR(10) NOT NULL UNIQUE, 
	USER_PASSWORD VARCHAR(50) NOT NULL, 
	USER_DATE_CREATED DATETIME(0) NOT NULL, 
	USER_DATE_MODIFIED DATETIME(0) NOT NULL
);


CREATE TABLE PERSONAL (
	USER_ID INTEGER PRIMARY KEY, FOREIGN KEY (USER_ID) REFERENCES USER(USER_ID), 
	PERSONAL_NAME VARCHAR(100) NOT NULL, 
	PERSONAL_DOB DATE NOT NULL, 
	PERSONAL_GENDER ENUM("MALE", "FEMALE", "OTHER") NOT NULL, 
	PERSONAL_ADDRESS VARCHAR(200) NOT NULL, 
	PERSONAL_PLACE VARCHAR(100) NOT NULL, 
	PERSONAL_DISTRICT VARCHAR(100) NOT NULL
);

CREATE TABLE FAMILY (
	FAMILY_ID INTEGER AUTO_INCREMENT PRIMARY KEY, 
	USER_ID INTEGER, FOREIGN KEY(USER_ID) REFERENCES USER(USER_ID), 
	FAMILY_NAME VARCHAR(100) NOT NULL, 
	FAMILY_AGE INTEGER NOT NULL,
	FAMILY_GENDER ENUM("MALE", "FEMALE", "OTHER") NOT NULL, 
	FAMILY_OCCUPATION VARCHAR(50) NOT NULL,
	FAMILY_RELATIONSHIP VARCHAR(50) NOT NULL
);

CREATE TABLE TRADING (
	USER_ID INTEGER PRIMARY KEY, FOREIGN KEY (USER_ID) REFERENCES USER(USER_ID),
	TRADING_FIRM_NAME VARCHAR(100) NOT NULL, 
	TRADING_FIRM_ADDRESS VARCHAR(200) NOT NULL,
	TRADING_FIRM_ANNUAL_TURNOVER DECIMAL(22,2) NOT NULL,
	TRADING_MTP_BRANCH VARCHAR(100) NOT NULL,
	TRADING_MTP_GODOWN VARCHAR(100) NOT NULL, 
	TRADING_MTP_FACTORY VARCHAR(100) NOT NULL,
	TRADING_MTP_OTHERS VARCHAR(100),
	TRADING_OWNERSHIP_TYPE VARCHAR(100) NOT NULL, 
	TRADING_CAPITAL_CONTRIBUTION DECIMAL(22, 2) NOT NULL,
	TRADING_GSTN_DATE VARCHAR(50) NOT NULL,
	TRADING_LICENSE_NUM VARCHAR(50) NOT NULL, 
	TRADING_LICENSE_AUTHORITY VARCHAR(50) NOT NULL,
	TRADING_OFFICIAL_NAME VARCHAR(100) NOT NULL
);

CREATE TABLE OTHER (
	USER_ID INTEGER PRIMARY KEY, FOREIGN KEY (USER_ID) REFERENCES USER(USER_ID),
	OTHER_EMV_MAIN_BRANCH DECIMAL(22, 2),
	OTHER_EMV_BRANCH DECIMAL(22, 2),
	OTHER_EMV_GODOWN DECIMAL(22, 2),
	OTHER_EMV_FACTORY DECIMAL(22, 2),
	OTHER_EMV_OTHERS DECIMAL(22, 2),
	ARA_MAIN_BRANCH DECIMAL(22, 2),
	ARA_BRANCH DECIMAL(22, 2),
	ARA_GODOWN DECIMAL(22, 2),
	ARA_FACTORY DECIMAL(22, 2), 
	ARA_OTHER DECIMAL(22, 2),
	OTHER_ORGANISATION_NAME VARCHAR(100)
);

CREATE TABLE BANKING (
	USER_ID INTEGER PRIMARY KEY, 
	FOREIGN KEY (USER_ID) REFERENCES USER(USER_ID), 
	BANKING_BANK_NAME VARCHAR(100) NOT NULL, 
	BANKING_ACC_NUMBER VARCHAR(13), 
	BANKING_ACC_HOLDER_NAME VARCHAR(100) NOT NULL, 
	BANKING_BANK_BRANCH VARCHAR(100) NOT NULL, 
	BANKING_IFSC_CODE CHAR(11)
);

CREATE TABLE PAYMENT (
	USER_ID INTEGER PRIMARY KEY,
	FOREIGN KEY (USER_ID) REFERENCES USER(USER_ID), 
	PAYMENT_REG_FEE DECIMAL(22, 2) NOT NULL,
	PAYMENT_ANNUAL_FEE DECIMAL(22, 2) NOT NULL,
	PAYMENT_CLASS VARCHAR(3) NOT NULL
);

CREATE TABLE CLAIMS (
	USER_ID INTEGER,
	FOREIGN KEY (USER_ID) REFERENCES USER(USER_ID),
	CLAIMS_APPLICATION_NO INTEGER AUTO_INCREMENT UNIQUE,
	CLAIMS_APPLICATION_TYPE VARCHAR(50) NOT NULL,
	CLAIMS_STATUS ENUM("-1","0","1","2","3", "4","5") NOT NULL
);