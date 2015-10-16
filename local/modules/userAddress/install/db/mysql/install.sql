create table if not exists b_user_address
(
	ID int(11) not null auto_increment,
	ID_USER int(18) not null,
	DEFAULT_ADDRESS CHAR(1) not null DEFAULT 'N',

	ZIP varchar(255),
	REGION varchar(255),
	DISTRICT varchar(255),
	CITY varchar(255),
	STREET varchar(255),
	HOME varchar(255),
	HOUSING varchar(255),
	FLAT varchar(255),

	DATE_CREATE datetime,
	DATE_UPDATE datetime,
	DATE_LAST_ADDRESS datetime,
	primary key (ID)
);