CREATE TABLE tx_project_domain_model_project (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    deleted tinyint(4) DEFAULT '0' NOT NULL,
    hidden tinyint(4) DEFAULT '0' NOT NULL,
    title varchar(255) DEFAULT '' NOT NULL,
    description text,
    status varchar(50) DEFAULT 'active' NOT NULL,
    responsible_members int(11) DEFAULT '0' NOT NULL,
    categories int(11) DEFAULT '0' NOT NULL,
    PRIMARY KEY (uid),
    KEY parent (pid)
);

CREATE TABLE tx_project_domain_model_event (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    deleted tinyint(4) DEFAULT '0' NOT NULL,
    hidden tinyint(4) DEFAULT '0' NOT NULL,
    title varchar(255) DEFAULT '' NOT NULL,
    event_date int(11) DEFAULT '0' NOT NULL,
    event_end_date int(11) DEFAULT '0' NOT NULL,
    location varchar(255) DEFAULT '' NOT NULL,
    description text,
    project int(11) DEFAULT '0' NOT NULL,
    participant_limit int(11) DEFAULT '0' NOT NULL,
    registration_enabled tinyint(4) DEFAULT '0' NOT NULL,
    registration_deadline int(11) DEFAULT '0' NOT NULL,
    registrations int(11) DEFAULT '0' NOT NULL,
    PRIMARY KEY (uid),
    KEY parent (pid)
);

CREATE TABLE tx_project_domain_model_eventregistration (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    deleted tinyint(4) DEFAULT '0' NOT NULL,
    hidden tinyint(4) DEFAULT '0' NOT NULL,
    fe_user int(11) DEFAULT '0' NOT NULL,
    event int(11) DEFAULT '0' NOT NULL,
    status varchar(50) DEFAULT 'registered' NOT NULL,
    reminder_sent tinyint(4) DEFAULT '0' NOT NULL,
    notes text,
    PRIMARY KEY (uid),
    KEY parent (pid)
);
