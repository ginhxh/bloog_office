CREATE TABLE article (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
img_url varchar(255),
    content TEXT NOT NULL,
    author_id INT(11),
    created_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
views_count varchar(255) defult 0,

    FOREIGN KEY (author_id) REFERENCES author(id)
);


CREATE TABLE likes(
     id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT,
    number_likes INT DEFAULT 0,
    FOREIGN KEY (article_id) REFERENCES article(id)
);
CREATE TABLE authore(
     id INT AUTO_INCREMENT PRIMARY KEY,
    username varchar(255),
    pwd varchar(255),
    email varchar(255),



    FOREIGN KEY (article_id) REFERENCES article(id)
);


CREATE TABLE commentes(
     id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT,
   comment text  ,
vstr_name varchar (255),
    created_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES article(id)
);


