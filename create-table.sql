create table [dbo].[Registration](
    id INT NOT NULL IDENTITY(1,1) PRIMARY KEY(id),
    namalengkap VARCHAR(50),
    asalkampus VARCHAR(50),
    prodi VARCHAR(50),
    email VARCHAR(50),
);
