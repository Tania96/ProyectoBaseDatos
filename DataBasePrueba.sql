-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "users";
CREATE TABLE "users" (
"id" integer NOT NULL,
"username" varchar(100) COLLATE "default",
"password" varchar(100) COLLATE "default",
"created_at" date DEFAULT ('now'::text)::date NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO "users" VALUES ('10', 'iparra', '123456', '2015-10-03');
COMMIT;

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "users" ADD PRIMARY KEY ("id");