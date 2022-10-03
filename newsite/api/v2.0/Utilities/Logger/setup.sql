CREATE TABLE IF NOT EXISTS tableprefix_process(
	id int(11) unsigned NOT NULL AUTO_INCREMENT,
	identifier varchar(255) DEFAULT '',
	resources int(11) unsigned NOT NULL DEFAULT 0,
	starts timestamp(6) NULL DEFAULT NULL,
	ends timestamp(6) NULL DEFAULT NULL,
	runtime double(20,16) unsigned NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS tableprefix_request(
	id int(11) unsigned NOT NULL AUTO_INCREMENT,
	process_id int(11) unsigned NOT NULL,
	method varchar(255) DEFAULT NULL,
	url varchar(255) DEFAULT NULL,
	headers text,
	body text,
	response longtext,
	http_code smallint(4) DEFAULT NULL,
	starts timestamp(6) NULL DEFAULT NULL,
	ends timestamp(6) NULL DEFAULT NULL,
	runtime double(20,16) unsigned NOT NULL,
	PRIMARY KEY (id),
	KEY tableprefix_process_request (process_id),
	CONSTRAINT tableprefix_process_request FOREIGN KEY (process_id) REFERENCES tableprefix_process (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS tableprefix_filenames (
	id int(11) unsigned NOT NULL AUTO_INCREMENT,
	filename varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (id),
	UNIQUE KEY tableprefix_unique_filenames (filename),
	KEY tableprefix_filenames (filename)
);

CREATE TABLE IF NOT EXISTS tableprefix_request_backtrace (
	id int(11) unsigned NOT NULL AUTO_INCREMENT,
	request_id int(11) unsigned NOT NULL,
	file_id int(11) unsigned NOT NULL,
	line int(11) NOT NULL,
	function varchar(255) NOT NULL DEFAULT '',
	args longtext,
	PRIMARY KEY (id),
	KEY tableprefix_requests_backtrace (request_id),
	KEY tableprefix_requests_backtrace_file (file_id),
	CONSTRAINT tableprefix_requests_backtrace_file FOREIGN KEY (file_id) REFERENCES tableprefix_filenames (id) ON UPDATE CASCADE,
	CONSTRAINT tableprefix_requests_backtrace FOREIGN KEY (request_id) REFERENCES tableprefix_request (id) ON DELETE CASCADE ON UPDATE CASCADE
);