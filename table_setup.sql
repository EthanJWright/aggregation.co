CREATE TABLE feeds (
  id int(11) NOT NULL,
  displayColumn int(11) NOT NULL,
  link varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  feedType varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE items (
  id int(11) NOT NULL,
  feedTitle varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  feedLink varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  itemTitle varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  itemPubDate varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  itemImage varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  itemLink varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  itemDesc mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE forums (
  id int(11) NOT NULL,
  feedTitle varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  feedLink varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  itemTitle varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  itemPubDate varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  itemImage varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  itemLink varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  itemDesc mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
