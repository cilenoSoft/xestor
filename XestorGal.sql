CREATE TABLE `comentarios_tarefa` (
`ID` int(11) NOT NULL AUTO_INCREMENT,
`ID_TAREFA` int(11) NOT NULL,
`LOGIN_USUARIO` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
`COMENTARIO` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
`ID_EQUIPO` int(11) NULL DEFAULT NULL,
`FECHA` datetime NULL DEFAULT NULL,
`ESTADO` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
PRIMARY KEY (`ID`) ,
INDEX `FK_ID_TAREFA` (`ID_TAREFA` ASC) USING BTREE,
INDEX `FK_ID_USUARIO` (`LOGIN_USUARIO` ASC) USING BTREE,
INDEX `FK_ESTADO_HIST` (`ESTADO` ASC) USING BTREE
)
ENGINE = MyISAM
AUTO_INCREMENT = 57
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `equipos` (
`ID` int(11) NOT NULL AUTO_INCREMENT,
`NOMBRE` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
`USUARIO_XESTOR` int(11) NOT NULL,
PRIMARY KEY (`ID`, `USUARIO_XESTOR`) ,
INDEX `ID` (`ID` ASC) USING BTREE,
INDEX `FK_user` (`USUARIO_XESTOR` ASC) USING BTREE
)
ENGINE = MyISAM
AUTO_INCREMENT = 62
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `estados_tarefa` (
`ID` int(3) NOT NULL,
`ESTADO` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
PRIMARY KEY (`ID`) 
)
ENGINE = MyISAM
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `rol` (
`ID` int(11) NOT NULL AUTO_INCREMENT,
`ROL` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
PRIMARY KEY (`ID`) 
)
ENGINE = MyISAM
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `tarefas` (
`ID` int(11) NOT NULL AUTO_INCREMENT,
`TITULO` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
`DESCRIPCION` varchar(1000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
`COMENTARIO` varchar(1000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
`ESTADO` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
`USUARIO_ULTIMO_ESTADO` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
`USUARIO_CREADOR` int(3) NOT NULL,
`FECHA_CREACION` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
`FECHA_ULTIMA_MODIFICACION` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`FECHA_FINALIZACION` datetime NULL DEFAULT NULL,
`FECHA_ENTREGA` datetime NULL DEFAULT NULL,
PRIMARY KEY (`ID`) ,
INDEX `FK_USUARIO_CREADOR` (`USUARIO_CREADOR` ASC) USING BTREE,
INDEX `FK_USUARIO_ULTIMO_ESTADO` (`USUARIO_ULTIMO_ESTADO` ASC) USING BTREE,
INDEX `FK_ESTADO` (`ESTADO` ASC) USING BTREE
)
ENGINE = MyISAM
AUTO_INCREMENT = 42
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `usuarios` (
`ID` int(11) NOT NULL AUTO_INCREMENT,
`LOGIN` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
`PASS` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
`EMAIL` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
`ID_EQUIPO` int(11) NULL DEFAULT NULL,
`ROL` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
`FECHA_REXISTRO` datetime NOT NULL,
PRIMARY KEY (`ID`) ,
INDEX `FK_ROL` (`ROL` ASC) USING BTREE,
INDEX `ID_EQUIP` (`ID_EQUIPO` ASC) USING BTREE
)
ENGINE = MyISAM
AUTO_INCREMENT = 13
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `usuarios_equipo` (
`ID_EQUIPO` int(11) NOT NULL,
`ID_USUARIO` int(11) NOT NULL,
PRIMARY KEY (`ID_EQUIPO`, `ID_USUARIO`) ,
INDEX `FK_ID_USUARIO_EQ` (`ID_USUARIO` ASC) USING BTREE
)
ENGINE = MyISAM
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Fixed;
CREATE TABLE `usuarios_tarefa` (
`ID_TAREFA` int(11) NOT NULL,
`ID_USUARIO` int(11) NOT NULL,
PRIMARY KEY (`ID_TAREFA`, `ID_USUARIO`) ,
INDEX `FK_ID_USUARIO_TAR` (`ID_USUARIO` ASC) USING BTREE
)
ENGINE = MyISAM
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Fixed;


-- ----------------------------
-- Records of comentarios_tarefa
-- ----------------------------
BEGIN;
INSERT INTO `comentarios_tarefa` VALUES (13, 13, 'diego', 'Comentario Proba 1', 60, '2019-11-28 20:17:40', 'PENDIENTE'), (2, 13, 'diego', 'Comentario Proba 2', 60, '2019-11-28 20:17:40', 'PENDIENTE'), (3, 13, 'diego', 'Comentario Proba 3', 60, '2019-11-28 20:17:40', 'PENDIENTE'), (4, 13, 'diego', 'Comentario Proba 4', 60, '2019-11-28 20:17:40', 'PENDIENTE'), (44, 13, 'diego', 'Comentario Proba 5', 60, '2019-11-28 20:17:40', 'PENDIENTE'), (45, 13, 'diego', 'Comentario Proba 6', 60, '2019-11-28 20:17:40', 'PENDIENTE'), (46, 2, 'diego', 'Comentario Proba 1', 60, '2019-11-28 20:17:40', 'PENDIENTE'), (47, 2, 'diego', 'Comentario Proba 2', 60, '2019-11-29 20:17:40', 'PENDIENTE'), (48, 2, 'diego', 'Comentario Proba 3', 60, '2019-11-30 20:17:40', 'EN PROGRESO'), (49, 14, 'diego', 'Comentario Proba 4', 60, '2019-11-28 20:17:40', 'PENDIENTE'), (50, 14, 'diego', 'Comentario Proba 5', 60, '2019-11-28 20:17:40', 'PENDIENTE'), (51, 13, 'diego', 'Comentario Proba 7', 60, '2019-12-05 12:43:41', 'FINALIZADA'), (52, 24, 'jose', 'Comentario Proba 1', 60, '2019-12-05 16:05:09', 'FINALIZADA'), (53, 14, 'diego', 'Comentario Proba 6', 60, '2019-12-06 11:58:24', 'EN PROCESO'), (54, 14, 'diego', 'Comentario Proba 7', 60, '2019-12-06 12:04:52', 'PENDIENTE'), (55, 1, 'diego', 'Comentario proba 1', 10, '2019-12-07 18:14:17', 'EN PROCESO'), (56, 1, 'diego', 'Comentario Proba2', 10, '2019-12-07 18:14:33', 'EN PROCESO');
COMMIT;

-- ----------------------------
-- Records of equipos
-- ----------------------------
BEGIN;
INSERT INTO `equipos` VALUES (10, 'Xestorgal', 4);
COMMIT;

-- ----------------------------
-- Records of estados_tarefa
-- ----------------------------
BEGIN;
INSERT INTO `estados_tarefa` VALUES (1, 'EN PROCESO'), (2, 'FINALIZADA'), (3, 'PENDIENTE'), (4, 'SIN ASIGNAR');
COMMIT;

-- ----------------------------
-- Records of rol
-- ----------------------------
BEGIN;
INSERT INTO `rol` VALUES (1, 'USER'), (2, 'MASTER');
COMMIT;

-- ----------------------------
-- Records of tarefas
-- ----------------------------
BEGIN;
INSERT INTO `tarefas` VALUES (1, 'Tarefa 1', 'Desarrollo de funciónes y pruebas.', NULL, 'EN PROCESO', 'diego', 4, '2019-12-07 18:14:33', '2019-12-07 18:14:33', '2019-11-30 18:47:21', NULL), (2, 'Tarefa 2', 'Desarrollo de funciónes y pruebas.', NULL, 'EN PROGRESO', 'diego', 4, '2019-12-07 18:12:04', '2019-12-07 18:12:04', '2019-11-30 19:11:45', NULL), (3, 'Tarefa 3', 'Desarrollo de funciónes y pruebas.', NULL, 'PENDIENTE', 'diego', 4, '2019-12-07 18:08:58', '2019-12-07 18:08:58', NULL, NULL), (4, 'Tarefa 4', 'Desarrollo de funciónes y pruebas.', NULL, 'PENDIENTE', 'diego', 4, '2019-12-07 18:08:58', '2019-12-07 18:08:58', NULL, NULL), (11, 'Tarefa 11', 'Desarrollo de funciónes y pruebas.', NULL, 'SIN ASIGNAR', 'diego', 4, '2019-12-07 18:15:53', '2019-12-07 18:15:53', '2019-12-05 00:26:35', '2019-12-05 00:26:35'), (12, 'Tarefa 12', 'Desarrollo de funciónes y pruebas.', NULL, 'SIN ASIGNAR', 'diego', 4, '2019-12-07 18:15:53', '2019-12-07 18:15:53', '2019-12-05 09:56:53', '2019-12-05 09:56:53'), (9, 'Tarefa 9', 'Desarrollo de funciónes y pruebas.', NULL, 'PENDIENTE', 'diego', 4, '2019-12-07 18:08:58', '2019-12-07 18:08:58', NULL, NULL), (10, 'Tarefa 10', 'Desarrollo de funciónes y pruebas.', NULL, 'SIN ASIGNAR', 'diego', 4, '2019-12-07 18:15:48', '2019-12-07 18:15:48', '2019-11-30 19:22:55', NULL), (13, 'Tarefa 13', 'Desarrollo de funciónes y pruebas.', NULL, 'FINALIZADA', 'diego', 4, '2019-12-07 18:08:58', '2019-12-07 18:08:58', '2019-12-05 12:43:41', '2019-12-05 12:43:41'), (15, 'Tarefa 15', 'Desarrollo de funciónes y pruebas.', NULL, 'PENDIENTE', 'diego', 4, '2019-12-07 18:08:58', '2019-12-07 18:08:58', '2019-12-05 11:47:58', '2019-12-05 11:47:58'), (16, 'Tarefa 16', 'Desarrollo de funciónes y pruebas.', NULL, 'PENDIENTE', 'diego', 4, '2019-12-07 18:08:58', '2019-12-07 18:08:58', NULL, NULL), (17, 'Tarefa 17', 'Desarrollo de funciónes y pruebas.', NULL, 'PENDIENTE', 'diego', 4, '2019-12-07 18:08:58', '2019-12-07 18:08:58', NULL, NULL), (18, 'Tarefa 18', 'Desarrollo de funciónes y pruebas.', NULL, 'PENDIENTE', 'diego', 4, '2019-12-07 18:08:58', '2019-12-07 18:08:58', NULL, NULL), (19, 'Tarefa 19', 'Desarrollo de funciónes y pruebas.', NULL, 'PENDIENTE', 'diego', 4, '2019-12-07 18:08:58', '2019-12-07 18:08:58', NULL, NULL), (20, 'Tarefa 20', 'Desarrollo de funciónes y pruebas.', NULL, 'PENDIENTE', 'diego', 4, '2019-12-07 18:08:58', '2019-12-07 18:08:58', NULL, NULL), (21, 'Tarefa 21', 'Desarrollo de funciónes y pruebas.', NULL, 'PENDIENTE', 'diego', 4, '2019-12-07 18:08:58', '2019-12-07 18:08:58', NULL, NULL);
COMMIT;


-- ----------------------------
-- Records of usuarios
-- ----------------------------
BEGIN;
INSERT INTO `usuarios` VALUES (4, 'diego', '$2y$10$SHhMCIyylhFLsq3QBtLIWORZNYbKeko.qxNgeOmcaoqVzIKs5SaNO', 'diego.vaz.rod@gmail.com', 10, 'MASTER', '2019-11-05 18:46:57'), (5, 'dvr', '$2y$10$s12FgZlzE8itjt6uKHFnxOavUCNAgm7Dg4ghrunP085WBK3bHSsUa', 'dvr@gmail.com', 10, 'MASTER', '2019-11-05 18:46:57'), (7, 'pedro', '$2y$10$CY1NKzJzvuTiR4O1ZF3DYOEkN/4BwFfFYgPWBldIkYuYQBhKB6qLu', 'pedro@gmail.com', 10, 'MASTER', '2019-11-05 18:46:57'), (9, 'juan', '$2y$10$LOijVLqkxIQyWE.i/idlrucJGQE4DlktgKVZ1TUboQ0YHqdNzrJyS', 'juan@gm.com', NULL, 'MASTER', '2019-11-05 18:46:57'), (8, 'david', '$2y$10$LOijVLqkxIQyWE.i/idlrucJGQE4DlktgKVZ1TUboQ0YHqdNzrJyS', 'david@gm.com', 10, 'MASTER', '2019-11-04 19:46:57'), (10, 'jose', '$2y$10$EYS5Hzcaqjz8dxxDD87wSuxjvUscUappW6V9dMAThpV4ElUCtbIFG', 'jose@xestorgal.com', 10, 'MASTER', '2019-11-05 18:46:57');
COMMIT;

-- ----------------------------
-- Records of usuarios_equipo
-- ----------------------------
BEGIN;
INSERT INTO `usuarios_equipo` VALUES (10, 4), (10, 5), (10, 7), (10, 8), (10, 10);
COMMIT;

-- ----------------------------
-- Table structure for usuarios_tarefa
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_tarefa`;
CREATE TABLE `usuarios_tarefa`  (
  `ID_TAREFA` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  PRIMARY KEY (`ID_TAREFA`, `ID_USUARIO`) USING BTREE,
  INDEX `FK_ID_USUARIO_TAR`(`ID_USUARIO`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_spanish_ci;

-- ----------------------------
-- Records of usuarios_tarefa
-- ----------------------------
BEGIN;
INSERT INTO `usuarios_tarefa` VALUES (1, 4), (2, 4), (10, 4), (11, 4), (12, 4), (13, 4), (14, 4), (15, 4), (20, 4), (22, 4), (40, 4), (41, 4);
COMMIT;


ALTER TABLE `usuarios` ADD CONSTRAINT `FK_EQUIPO` FOREIGN KEY (`ID_EQUIPO`) REFERENCES `equipos` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `equipos` ADD CONSTRAINT `FK_USUARIO` FOREIGN KEY (`USUARIO_XESTOR`) REFERENCES `usuarios` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
ALTER TABLE `tarefas` ADD CONSTRAINT `fk_estado` FOREIGN KEY (`ESTADO`) REFERENCES `estados_tarefa` (`ESTADO`) ON DELETE NO ACTION ON UPDATE CASCADE;
ALTER TABLE `usuarios_tarefa` ADD CONSTRAINT `fk_user_tarefa` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `usuarios_tarefa` ADD CONSTRAINT `fk_tarefa` FOREIGN KEY (`ID_TAREFA`) REFERENCES `tarefas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `usuarios_equipo` ADD CONSTRAINT `fk_user_equi` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `usuarios_equipo` ADD CONSTRAINT `fk_id_equip` FOREIGN KEY (`ID_EQUIPO`) REFERENCES `equipos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `usuarios` ADD CONSTRAINT `fk_rol` FOREIGN KEY (`ROL`) REFERENCES `rol` (`ROL`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `comentarios_tarefa` ADD CONSTRAINT `fk_tar` FOREIGN KEY (`ID_TAREFA`) REFERENCES `tarefas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `comentarios_tarefa` ADD CONSTRAINT `fk_login` FOREIGN KEY (`LOGIN_USUARIO`) REFERENCES `usuarios` (`LOGIN`) ON DELETE NO ACTION ON UPDATE CASCADE;
ALTER TABLE `comentarios_tarefa` ADD CONSTRAINT `fk_equi` FOREIGN KEY (`ID_EQUIPO`) REFERENCES `equipos` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
ALTER TABLE `comentarios_tarefa` ADD CONSTRAINT `fk_estado_tar` FOREIGN KEY (`ESTADO`) REFERENCES `estados_tarefa` (`ESTADO`) ON DELETE NO ACTION ON UPDATE CASCADE;

