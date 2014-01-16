-- ----------------------------
--  Table structure for "admin_menus"
-- ----------------------------
DROP TABLE IF EXISTS "admin_menus";
CREATE TABLE "admin_menus" (
	"name" varchar(100) NOT NULL DEFAULT NULL::character varying,
	"display_name" varchar(100) NOT NULL DEFAULT NULL::character varying,
	"required_level" int4 NOT NULL DEFAULT 0,
	"uri" varchar(100) DEFAULT NULL::character varying,
	"weight" int4 NOT NULL DEFAULT 0,
	"route_name" varchar DEFAULT NULL,
	"parent" varchar(100) DEFAULT NULL::character varying,
	"icon" varchar(50) DEFAULT NULL,
	"enabled" int2 DEFAULT 1
)
WITH (OIDS=FALSE);
ALTER TABLE "admin_menus" OWNER TO "dreamheaven";

-- ----------------------------
--  Records of "admin_menus"
-- ----------------------------
BEGIN;
INSERT INTO "admin_menus" VALUES ('admin_home', '首页', '0', null, '0', 'admin_dashboard', null, 'icon-home', '1');
INSERT INTO "admin_menus" VALUES ('admin_content_approval_photos', '公开照片', '0', '/admin/content_approval/photos', '240', null, 'admin_content_approval', 'icon-picture', '1');
INSERT INTO "admin_menus" VALUES ('admin_content_approval_comments', '评论', '0', '/admin/content_approval/comments', '260', null, 'admin_content_approval', 'icon-comment', '1');
INSERT INTO "admin_menus" VALUES ('admin_content_approval_statuses', '状态', '0', '/admin/content_approval/statuses', '250', null, 'admin_content_approval', 'icon-comment', '1');
INSERT INTO "admin_menus" VALUES ('admin_content_approval', '内容审核', '0', null, '200', null, null, 'icon-check', '1');
INSERT INTO "admin_menus" VALUES ('admin_content_approval_avatars', '头像审核', '0', '/admin/content_approval/avatars', '210', null, 'admin_content_approval', 'icon-user', '1');
INSERT INTO "admin_menus" VALUES ('admin_content_approval_names', '实名认证', '0', '/admin/content_approval/names', '220', null, 'admin_content_approval', 'icon-font', '1');
INSERT INTO "admin_menus" VALUES ('admin_content_approval_splashes', '个性封面', '0', '/admin/content_approval/splashes', '230', null, 'admin_content_approval', 'icon-picture', '0');
INSERT INTO "admin_menus" VALUES ('admin_cusomer_service', '客服系统', '0', '/admin/customer_service', '100', null, null, 'icon-tasks', '1');
COMMIT;

-- ----------------------------
--  Primary key structure for table "admin_menus"
-- ----------------------------
ALTER TABLE "admin_menus" ADD CONSTRAINT "admin_menus_pkey" PRIMARY KEY ("name");

