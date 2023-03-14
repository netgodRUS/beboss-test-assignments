<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>Alphabetical Index of Cities</title>
            </head>
            <body>
                <h1>Alphabetical Index of Cities</h1>

                <ul>
                    <!-- Group the cities by the first letter of their name -->
                    <xsl:for-each select="//node">
                        <xsl:sort select="name" />
                        <xsl:if test="not(starts-with(name, preceding-sibling::node[1]/name))">
                            <li><strong><xsl:value-of select="substring(name, 1, 1)" /></strong></li>
                        </xsl:if>
                        <li><a href="{name_latin}"><xsl:value-of select="name" /></a></li>
                    </xsl:for-each>
                </ul>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
