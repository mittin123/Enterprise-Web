ALTER TABLE blog
  DROP PRIMARY KEY;

ALTER TABLE blog
ADD PRIMARY KEY (id);

ALTER TABLE blog
ADD FOREIGN KEY (user) REFERENCES account(username) ON DELETE CASCADE;

ALTER TABLE account
ADD FOREIGN KEY (email) REFERENCES tutor(email) ON DELETE CASCADE;

ALTER TABLE account
ADD FOREIGN KEY (email) REFERENCES student(email) ON DELETE CASCADE;

ALTER TABLE student_tutor
ADD FOREIGN KEY (tutor_code) REFERENCES tutor(code) ON DELETE CASCADE;

ALTER TABLE student_tutor
ADD FOREIGN KEY (student_code) REFERENCES student(code) ON DELETE CASCADE;

ALTER TABLE student_arange
ADD FOREIGN KEY (std_tutor_id) REFERENCES student_tutor(id) ON DELETE CASCADE;

ALTER TABLE folder
ADD FOREIGN KEY (std_tutor_id) REFERENCES student_tutor(id) ON DELETE CASCADE;

ALTER TABLE file_detail
ADD FOREIGN KEY (folder_id) REFERENCES student_arange(id) ON DELETE CASCADE;

ALTER TABLE folder
ADD FOREIGN KEY (folder_id) REFERENCES folder(id) ON DELETE CASCADE;

ALTER TABLE blog
ADD UNIQUE (user);

ALTER TABLE account
ADD UNIQUE (username);

ALTER TABLE tutor
ADD UNIQUE (email);

ALTER TABLE student
ADD UNIQUE (email);

ALTER TABLE tutor
ADD UNIQUE (code);

ALTER TABLE student
ADD UNIQUE (code);

ALTER TABLE blog
ADD UNIQUE (user);

ALTER TABLE student_tutor
ADD UNIQUE (student_code);

