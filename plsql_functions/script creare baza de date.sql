DROP TABLE parfumuri;
CREATE TABLE parfumuri (
  id INT NOT NULL,
  poza varchar2(400),
  nume varchar2(400),
  brand varchar2(400),
  cantitate varchar2(200),
  pret varchar2(200),
  sex int,
  stoc int,
  note varchar2(400),
  data_lansare varchar2(400),
  sezon varchar2(400),
  ocazie varchar2(400),
  discount int
)
/
DROP TABLE clienti;
CREATE TABLE clienti (
  email varchar2(400),
  adresa varchar2(400),
  preferinta_ocazie varchar2(400),
  preferinta_nota varchar2(400),
  preferinta_sezon varchar2(400)
)
/
DROP TABLE shoppingCart;
CREATE TABLE shoppingCart
(
 id INT NOT NULL,
 id_parfum int,
 email varchar2(400),
 cantitate int,
 cost int
)
/
DROP TABLE comenzi;
CREATE TABLE comenzi
(
 id INT NOT NULL,
 id_parfum int,
 email varchar2(400),
 cantitate int,
 cost int,
 data_comanda date,
 stare varchar2(400)
)
/
DROP TABLE raport;
CREATE TABLE raport
(
 id int not null
)
/
insert into raport values (1);
/
insert into comenzi values(1,29638,'iavflorin@gmail.com',4,500,'04-APR-19','in curs de livrare');
insert into comenzi values(2,29649,'iavflorin@gmail.com',4,500,sysdate,'in curs de livrare');
insert into comenzi values(3,29638,'iavflorin@gmail.com',5,500,sysdate,'in curs de livrare');
insert into comenzi values(4,29628,'iavflorin@gmail.com',4,500,'07-MAY-19','in curs de livrare');
insert into comenzi values(5,29623,'iavflorin@gmail.com',3,500,sysdate,'in curs de livrare');
insert into comenzi values(6,29629,'iavflorin@gmail.com',2,500,sysdate,'in curs de livrare');
insert into comenzi values(7,15,'iavflorin@gmail.com',10,500,sysdate,'in curs de livrare');
insert into comenzi values(8,21,'iavflorin@gmail.com',3,500,sysdate,'in curs de livrare');
insert into comenzi values(9,33,'toma_the_cat@gmail.com',9,500,'21-JAN-19','in curs de livrare');
insert into comenzi values(10,44,'iavflorin@gmail.com',8,500,sysdate,'in curs de livrare');
insert into comenzi values(11,55,'iavflorin@gmail.com',10,500,sysdate,'in curs de livrare');
insert into comenzi values(11,66,'toma_the_cat@gmail.com',7,500,sysdate,'in curs de livrare');
insert into comenzi values(11,66,'vcosmin@gmail.com',7,500,sysdate,'in curs de livrare');
insert into comenzi values(11,66,'iavflorin@gmail.com',7,500,sysdate,'in curs de livrare');
insert into comenzi values(11,66,'iavflorin@gmail.com',7,500,sysdate,'in curs de livrare');
insert into comenzi values(11,66,'iavflorin@gmail.com',7,500,sysdate,'in curs de livrare');
/
DECLARE
v_fisier1 UTL_FILE.FILE_TYPE;
v_sir VARCHAR2(400);
v_poza varchar2(400);
v_nume varchar2(400);
v_brand varchar2(400);
v_cantitate varchar2(200);
v_pret varchar2(200);
v_stoc int;
v_note varchar2(400);
v_data_lansare varchar2(400);
v_sezon varchar2(400);
v_ocazie varchar2(400);
i  pls_integer := 0;
v_z int :=1;
v_zero int :=0;
v_optiune int :=1;
BEGIN
LOOP
IF(v_optiune=1)
THEN
v_fisier1:=UTL_FILE.FOPEN('MYDIR','manFragrances.txt','R');
ELSIF (v_optiune=2)
THEN
v_fisier1:=UTL_FILE.FOPEN('MYDIR','womanFragrances.txt','R');
ELSIF (v_optiune=3)
THEN
v_fisier1:=UTL_FILE.FOPEN('MYDIR','sharedFragrances.txt','R');
ELSE
EXIT;
END IF;
LOOP
     BEGIN
        UTL_FILE.GET_LINE(v_fisier1,v_sir);
     EXCEPTION
      WHEN NO_DATA_FOUND THEN EXIT;
     END;
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_poza := substr(v_sir, 1, i - 1); 
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_nume := substr(v_sir, 1, i - 1);
    IF (v_nume='\')
    THEN
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_nume := substr(v_sir, 1, i - 2);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_nume := v_nume || substr(v_sir, 1, i - 1);
    END IF; 
     i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_brand := substr(v_sir, 1, i - 1); 
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, ',');
    v_cantitate := substr(v_sir, 2, i - 2);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, ',');
    v_pret := substr(v_sir, 2, i - 2);  
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_note := substr(v_sir, 1, i - 1);
     i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_data_lansare := substr(v_sir, 1, i - 1); 
     i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sezon := substr(v_sir, 1, i - 1); 
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_sir := substr(v_sir, i + 1);
    i := instr(v_sir, '"');
    v_ocazie := substr(v_sir, 1, i - 1); 
    v_stoc := FLOOR(DBMS_RANDOM.VALUE(5,201));
    insert into parfumuri values(v_z,v_poza,v_nume,v_brand,v_cantitate,v_pret,v_optiune,v_stoc,v_note,v_data_lansare,v_sezon,v_ocazie,v_zero);
    commit;
    v_z := v_z+1;
END LOOP;
v_optiune := v_optiune +1;
END LOOP;
UTL_FILE.FCLOSE(v_fisier1);
delete from parfumuri where pret is null or cantitate is null;
insert into shoppingCart values(1,0,'fantoma',0,0);
END;