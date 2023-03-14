<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html"/>

  <!-- Derive a tree of user types -->
  <xsl:template match="/">
    <h1>User Types</h1>
    <ul>
      <xsl:apply-templates select="users/usertypes/usertype[id_parent=0]"/>
    </ul>
  </xsl:template>

  <xsl:template match="usertype">
    <li>
      <xsl:value-of select="title"/>
      <ul>
        <xsl:apply-templates select="../../usertypes/usertype[id_parent=current()/id]"/>
      </ul>
    </li>
  </xsl:template>

  <!-- Display a list of users -->
  <xsl:template match="users">
    <h1>List of Users</h1>
    <ul>
      <xsl:apply-templates select="userdescriptions/user"/>
    </ul>
  </xsl:template>

  <xsl:template match="user">
    <li>