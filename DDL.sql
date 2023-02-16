-- Create and initialize the Books table --
CREATE TABLE Books (
    ISBN        char(14),
    Title       varchar(40) NOT NULL,
    Author      varchar(40) NOT NULL,
    Publisher   varchar(40),
    Category    varchar(9) NOT NULL,
    Price       numeric(12,2) NOT NULL DEFAULT 10,
    Stock_qty   integer DEFAULT 0,
    PRIMARY KEY (ISBN),
    CONSTRAINT category_ck CHECK (Category in ('Fantasy', 'Horror', 'Adventure', 'Fiction'))
);
CREATE INDEX book_title ON Books (Title);
CREATE INDEX book_author ON Books (Author);
CREATE INDEX book_publisher ON Books (Publisher);
CREATE INDEX book_category ON Books (Category);

INSERT INTO Books VALUES ('978-0140430721', 'Pride and Prejudice', 'Jane Austen', 'Penguin Classics', 'Fiction', 4.57, 15);
INSERT INTO Books VALUES ('978-1501156700', 'Pet Sematary', 'Stephen King', 'Pocket Books', 'Horror', 15.82, 10);
INSERT INTO Books VALUES ('978-0486280615', 'The Adventures of Huckleberry Finn', 'Mark Twain', 'Dover Publications', 'Adventure', 5.39, 6);
INSERT INTO Books VALUES ('978-1953649904', 'The Adventures of Tom Sawyer', 'Mark Twain', 'SeaWolf Press', 'Adventure', 9.95, 3);
INSERT INTO Books VALUES ('978-0553386790', 'Game of Thrones (A Song of Ice and Fire)', 'George R. R. Martin', 'Bantam', 'Fantasy', 13.86, 21);

-- Create and initialize the Reviews table --
CREATE TABLE Reviews (
    ID              SMALLINT NOT NULL AUTO_INCREMENT,
    Book_ISBN       char(14) NOT NULL,
    Review_text     Text NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (Book_ISBN) REFERENCES Books(ISBN)
);
CREATE INDEX review_book_isbn ON Reviews (Book_ISBN);

INSERT INTO Reviews (Book_ISBN, Review_text) VALUES ('978-0140430721', 'I was forced to read this by my future wife. I was not, however, forced to give it 5 stars.');
INSERT INTO Reviews (Book_ISBN, Review_text) VALUES ('978-0140430721', '"Pride and Prejudice" by Jane Austen started off annoying me and ended up enchanting me. Up until about page one hundred I found this book vexing, frivolous and down right tedious. I now count myself as a convert to the Austen cult. I must confess I have been known to express an antipathy for anything written or set before 1900. I just cannot get down with corsets, outdoor plumbing and buggy rides. Whenever someone dips a quill into an inkwell my eyes glaze over. This is a shortcoming I readily own up to but have no desire to correct. So I admit to not starting this book with the highest of hopes. I did really enjoy Ang Lees "Sense and Sensibility" however and so when my friend threw the gauntlet down I dutifully picked it up. Boy did I hate him at first. To get anywhere with this book one has to immerse oneself in the realities of life and marriage in the nineteenth century. At first all this talk of entailment and manners just left me cold. I liked the language to be sure. Austens dialogue is delightful through out but dialogue alone (no matter how delicious) does not a great novel make. A hundred pages or so in though I started to see what a shrewd eye for character this Austen woman had. Mr. Collins was the first person I marvelled at. His character springs forth fully formed as a total but somehow loveable ass. From that point on I found much to love about this book. I was so into it by the end that I was laughing at some characters, sympathizing with others and clucking my tongue at an unhappy few. In short I was completely absorbed. In conclusion I must now count myself a fan of Miss Austens novels (and not just their fim adaptations) and do so look forward to acqauinting myself with more of her work in the future.');
INSERT INTO Reviews (Book_ISBN, Review_text) VALUES ('978-1501156700', 'I absolutely LOVED rereading Pet Sematary. The experience filled my whole heart with nostalgic glee.');
INSERT INTO Reviews (Book_ISBN, Review_text) VALUES ('978-0486280615', 'One of my absolute favourite books, which I have read multiple times. A major classic. If at all possible, get an edition with the original illustrations.');
INSERT INTO Reviews (Book_ISBN, Review_text) VALUES ('978-0486280615', 'tom sawyer was a vexation on my spirit and Im so glad I finished this so I never have to hear from him again');
INSERT INTO Reviews (Book_ISBN, Review_text) VALUES ('978-0486280615', 'The Adventures of Huckleberry Finn. Hilarious, colourful, refreshingly simple, chaotic mess that life throws at you, ...splat in the face.');
INSERT INTO Reviews (Book_ISBN, Review_text) VALUES ('978-1953649904', 'The Adventures of Tom Sawyer, published by Samuel Langhorne Clemens, (Mark Twain) in 1876, is a most engaging childrens book. It describes an American boys childhood in a rural Southern town in the 19th century. I read this many years ago, and always promised myself that Id read it again, and you know something? It didnt disappoint. Theres a reason that its a classic. Just lovely.');
INSERT INTO Reviews (Book_ISBN, Review_text) VALUES ('978-0553386790', 'A slow parade of entropy, its a panoply of pain: a delicate sweater, knit finely together, unraveled to a tangled skein.');

-- Create and initialize the Customers table --
CREATE TABLE Customers (
    Username        varchar(20),
    Pin             integer NOT NULL,
    FirstName       varchar(20) NOT NULL,
    LastName        varchar(20) NOT NULL,
    Street          varchar(20) NOT NULL,
    City            varchar(20) NOT NULL,
    State           varchar(10) NOT NULL,
    ZipCode         integer NOT NULL,
    ccNumber        char(16) NOT NULL,
    ccType          varchar(8) NOT NULL,
    ccExpDate       varchar(10) NOT NULL,
    PRIMARY KEY (Username),
    CONSTRAINT pin_ck CHECK (Pin BETWEEN 0 AND 9999),
    CONSTRAINT zip_ck CHECK (ZipCode BETWEEN 0 AND 99999),
    CONSTRAINT ccType_ck CHECK (ccType in ('VISA', 'MASTER', 'DISCOVER')),
    CONSTRAINT state_ck CHECK (State in ('California', 'Michigan', 'Tennessee'))
);

-- Create and initialize the Purchases table --
CREATE TABLE Purchases (
    Time            DATETIME,
    Book_ISBN       char(14),
    Username        varchar(20),
    Quantity        integer,
    PRIMARY KEY (Time, Book_ISBN, Username),
    FOREIGN KEY (Book_ISBN) REFERENCES Books(ISBN),
    FOREIGN KEY (Username) REFERENCES Customers(Username)
);