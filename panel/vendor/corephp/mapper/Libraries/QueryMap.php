<?php

namespace CorePHP\Libraries;

class QueryMap
{

    public $queryList = array();
    

    public function AdministradoresQuery()
    {
        $this->queryList['Administradores'] = array(
            "getItem" => "SELECT * FROM Administradores WHERE idAdministrador = [[id]]",
            "getAllItems" => "SELECT * FROM Administradores",
            "getItemByUser" => "SELECT * FROM Administradores WHERE correo = '[[user]]'",
            "getItemByPassword" => "SELECT * FROM Administradores WHERE passwd = '[[password]]'",
            "insertItem" => "INSERT INTO Administradores (correo,passwd) VALUES ('[[correo]]','[[passwd]]')",
            "updateItem" => "UPDATE Administradores SET [[data]] WHERE idAdministrador = [[id]]",
            "deleteItem" => "DELETE FROM Administradores WHERE idAdministrador = [[id]]",
            "getLastItem" => "SELECT MAX(idAdministrador) AS 'last' FROM Administradores"
        );
    }

    public function CheckDocumentosQuery()
    {
        $this->queryList['CheckDocumentos'] = array(
            "getItem" => "SELECT * FROM CheckDocumentos WHERE idCheckDocumento = [[id]]",
            "getAllItems" => "SELECT * FROM CheckDocumentos",
            "insertItem" => "INSERT INTO CheckDocumentos (documento,infante) VALUES ([[documento]],[[infante]])",
            "updateItem" => "UPDATE CheckDocumentos SET [[data]] WHERE idCheckDocumento = [[id]]",
            "deleteItem" => "DELETE FROM CheckDocumentos WHERE idCheckDocumento = [[id]]",
            "getLastItem" => "SELECT MAX(idCheckDocumento) AS 'last' FROM CheckDocumentos",
            "getAllItemsByInfante" => "SELECT * FROM CheckDocumentos WHERE infante = [[id]]"
        );
    }

    public function CheckJuegosQuery()
    {
        $this->queryList['CheckJuegos'] = array(
            "getItem" => "SELECT * FROM CheckJuegos WHERE idCheckJuego = [[id]]",
            "getAllItems" => "SELECT * FROM CheckJuegos",
            "insertItem" => "INSERT INTO CheckJuegos (juego,infante) VALUES ([[juego]],[[infante]])",
            "updateItem" => "UPDATE CheckJuegos SET [[data]] WHERE idCheckJuego = [[id]]",
            "deleteItem" => "DELETE FROM CheckJuegos WHERE idCheckJuego = [[id]]",
            "getLastItem" => "SELECT MAX(idCheckJuego) AS 'last' FROM CheckJuegos",
            "getAllItemsByInfante" => "SELECT * FROM CheckJuegos WHERE infante = [[id]]"
        );
    }

    public function CheckVideosQuery()
    {
        $this->queryList['CheckVideos'] = array(
            "getItem" => "SELECT * FROM CheckVideos WHERE idCheckVideo = [[id]]",
            "getAllItems" => "SELECT * FROM CheckVideos",
            "insertItem" => "INSERT INTO CheckVideos (video,infante) VALUES ([[video]],[[infante]])",
            "updateItem" => "UPDATE CheckVideos SET [[data]] WHERE idCheckVideo = [[id]]",
            "deleteItem" => "DELETE FROM CheckVideos WHERE idCheckVideo = [[id]]",
            "getLastItem" => "SELECT MAX(idCheckVideo) AS 'last' FROM CheckVideos",
            "getAllItemsByInfante" => "SELECT * FROM CheckVideos WHERE infante = [[id]]"
        );
    }

    public function CursosQuery()
    {
        $this->queryList['Cursos'] = array(
            "getItem" => "SELECT * FROM Cursos WHERE idCurso = [[id]]",
            "getAllItems" => "SELECT * FROM Cursos",
            "insertItem" => "INSERT INTO Cursos (titulo,descripcion,temario) VALUES ('[[titulo]]','[[descripcion]]','[[temario]]')",
            "updateItem" => "UPDATE Cursos SET [[data]] WHERE idCurso = [[id]]",
            "deleteItem" => "DELETE FROM Cursos WHERE idCurso = [[id]]",
            "getLastItem" => "SELECT MAX(idCurso) AS 'last' FROM Cursos"
        );
    }

    public function DocumentosCursoQuery()
    {
        $this->queryList['DocumentosCurso'] = array(
            "getItem" => "SELECT * FROM DocumentosCurso WHERE idDocumentoCurso = [[id]]",
            "getAllItems" => "SELECT * FROM DocumentosCurso",
            "insertItem" => "INSERT INTO DocumentosCurso (documento,titulo,curso) VALUES ('[[documento]]','[[titulo]]',[[curso]])",
            "updateItem" => "UPDATE DocumentosCurso SET [[data]] WHERE idDocumentoCurso = [[id]]",
            "deleteItem" => "DELETE FROM DocumentosCurso WHERE idDocumentoCurso = [[id]]",
            "getLastItem" => "SELECT MAX(idDocumentoCurso) AS 'last' FROM DocumentosCurso",
            "getAllItemsByCurso" => "SELECT * FROM DocumentosCurso WHERE curso = [[id]]"
        );
    }

    public function InfantesQuery()
    {
        $this->queryList['Infantes'] = array(
            "getItem" => "SELECT * FROM Infantes WHERE idInfante = [[id]]",
            "getAllItems" => "SELECT * FROM Infantes",
            "insertItem" => "INSERT INTO Infantes (nombre,paterno,materno,tutor,hashcode) VALUES ('[[nombre]]','[[paterno]]','[[materno]]',[[tutor]],'[[hashcode]]')",
            "updateItem" => "UPDATE Infantes SET [[data]] WHERE idInfante = [[id]]",
            "deleteItem" => "DELETE FROM Infantes WHERE idInfante = [[id]]",
            "getLastItem" => "SELECT MAX(idInfante) AS 'last' FROM Infantes",
            "getAllItemsByTutor" => "SELECT * FROM Infantes WHERE tutor = [[id]]"
        );
    }

    public function InscritosCursoQuery()
    {
        $this->queryList['InscritosCurso'] = array(
            "getItem" => "SELECT * FROM InscritosCurso WHERE idInscritoCurso = [[id]]",
            "getAllItems" => "SELECT * FROM InscritosCurso",
            "insertItem" => "INSERT INTO InscritosCurso (curso,infante) VALUES ([[curso]],[[infante]])",
            "updateItem" => "UPDATE InscritosCurso SET [[data]] WHERE idInscritoCurso = [[id]]",
            "deleteItem" => "DELETE FROM InscritosCurso WHERE idInscritoCurso = [[id]]",
            "getLastItem" => "SELECT MAX(idInscritoCurso) AS 'last' FROM InscritosCurso",
            "getAllItemsByCurso" => "SELECT * FROM Infantes WHERE tutor = [[id]]",
            "getAllItemsByInfante" => "SELECT * FROM Infantes WHERE tutor = [[id]]"
        );
    }

    public function JuegosCursoQuery()
    {
        $this->queryList['JuegosCurso'] = array(
            "getItem" => "SELECT * FROM JuegosCurso WHERE idJuegoCurso = [[id]]",
            "getAllItems" => "SELECT * FROM JuegosCurso",
            "insertItem" => "INSERT INTO JuegosCurso (path,titulo,curso) VALUES ('[[path]]','[[titulo]]',[[curso]])",
            "updateItem" => "UPDATE JuegosCurso SET [[data]] WHERE idJuegoCurso = [[id]]",
            "deleteItem" => "DELETE FROM JuegosCurso WHERE idJuegoCurso = [[id]]",
            "getLastItem" => "SELECT MAX(idJuegoCurso) AS 'last' FROM JuegosCurso",
            "getAllItemsByCurso" => "SELECT * FROM JuegosCurso WHERE curso = [[id]]"
        );
    }

    public function PadresQuery()
    {
        $this->queryList['Padres'] = array(
            "getItem" => "SELECT * FROM Padres WHERE idPadre = [[id]]",
            "getAllItems" => "SELECT * FROM Padres",
            "getItemByUser" => "SELECT * FROM Padres WHERE correo = '[[user]]'",
            "insertItem" => "INSERT INTO Padres (nombre,paterno,materno,correo,passwd) VALUES ('[[nombre]]','[[paterno]]','[[materno]]','[[correo]]','[[passwd]]')",
            "updateItem" => "UPDATE Padres SET [[data]] WHERE idPadre = [[id]]",
            "deleteItem" => "DELETE FROM Padres WHERE idPadre = [[id]]",
            "getLastItem" => "SELECT MAX(idPadre) AS 'last' FROM Padres",
        );
    }

    public function VideosCursoQuery()
    {
        $this->queryList['VideosCurso'] = array(
            "getItem" => "SELECT * FROM VideosCurso WHERE idVideoCurso = [[id]]",
            "getAllItems" => "SELECT * FROM VideosCurso",
            "insertItem" => "INSERT INTO VideosCurso (frame,titulo,curso) VALUES ('[[frame]]','[[titulo]]',[[curso]])",
            "updateItem" => "UPDATE VideosCurso SET [[data]] WHERE idVideoCurso = [[id]]",
            "deleteItem" => "DELETE FROM VideosCurso WHERE idVideoCurso = [[id]]",
            "getLastItem" => "SELECT MAX(idVideoCurso) AS 'last' FROM VideosCurso",
            "getAllItemsByCurso" => "SELECT * FROM VideosCurso WHERE curso = [[id]]"
        );
    }
}