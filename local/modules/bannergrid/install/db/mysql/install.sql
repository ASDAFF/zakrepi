create table if not exists b_banner_grid
(
	ID int(11) not null auto_increment,
	BG_NUMBER int(18) not null,
	BG_IDBANERS int(18) not null,
	primary key (ID)
);