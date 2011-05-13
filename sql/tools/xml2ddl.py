
#! /usr/bin/env python
# -*- coding: iso-8859-1 -*-

import re, os
from xml.dom.minidom import parse, parseString

__author__ = "Scott Kirkwood (scott_kirkwood at berlios.com)"
__keywords__ = ['XML', 'DML', 'SQL', 'Databases', 'Agile DB', 'ALTER', 'CREATE TABLE', 'GPL']
__licence__ = "GNU Public License (GPL)"
__longdescr__ = ""
__url__ = 'http://xml2dml.berlios.de'
__version__ = "$Revision: 0.2 $"

"""
Supports:
    - Primary keys and primary keys on multiple columns.
    - Foreign key relations (constraint)
        - todo: multiple fk constraints
    - Indexes
    - Check constraint - not done...
    - UNIQUE constraint - not done...
    - Autoincrement or the nearest equivalent depending on the database
    
Notes:
    - I explicitly set the constraint and index names instead of using the defaults for things like PRIMARY KEY
      etc.  This makes it easier to perform modifications when needed. There is no way to 
      specify the constraint names in the XML (at least the moment)

TODO:
    - encrypted flag?

http://weblogs.asp.net/jamauss/articles/DatabaseNamingConventions.aspx

"""

class Xml2Ddl:
    def __init__(self):
        self._setDefaults()
        self.reset()
        
    def reset(self):
        self.ddls = []
        
    
    def _setDefaults(self):
        self.dbmsType = 'postgres'
        self.params = {
            'drop-tables' : True,
            'output_primary_keys' : True,
            'output_references' : True,
            'output_indexes' : True,
            'add_dataset' : True,
            'table_desc' : "COMMENT ON TABLE %(table)s IS %(desc)s",
            'column_desc' : "COMMENT ON COLUMN %(table)s.%(column)s IS %(desc)s",
            'unquoted_id' : re.compile(r'^[A-Za-z][A-Za-z0-9_]+$'),
            'max_id_len' : { 'default' : 256 },
            'has_auto_increment' : False,
            'keywords' : [ 'NULL', 'SELECT', 'FROM' ],
            'quote_l' : '"',
            'quote_r' : '"',
        }

    def setDbms(self, dbms):
        self._setDefaults()
        
        self.dbmsType = dbms.lower()
        if self.dbmsType == 'firebird':
            self.params['table_desc'] = "UPDATE RDB$RELATIONS SET RDB$DESCRIPTION = %(desc)s\n\tWHERE RDB$RELATION_NAME = upper('%(table)s')"
            self.params['column_desc'] = "UPDATE RDB$RELATION_FIELDS SET RDB$DESCRIPTION = %(desc)s\n\tWHERE RDB$RELATION_NAME = upper('%(table)s') AND RDB$FIELD_NAME = upper('%(column)s')"
            self.params['max_id_len'] = { 'default' : 256 }
            self.params['keywords'] = """
                ACTION ACTIVE ADD ADMIN AFTER ALL ALTER AND ANY AS ASC ASCENDING AT AUTO AUTODDL AVG BASED BASENAME BASE_NAME 
                BEFORE BEGIN BETWEEN BLOB BLOBEDIT BUFFER BY CACHE CASCADE CAST CHAR CHARACTER CHARACTER_LENGTH CHAR_LENGTH
                CHECK CHECK_POINT_LEN CHECK_POINT_LENGTH COLLATE COLLATION COLUMN COMMIT COMMITTED COMPILETIME COMPUTED CLOSE 
                CONDITIONAL CONNECT CONSTRAINT CONTAINING CONTINUE COUNT CREATE CSTRING CURRENT CURRENT_DATE CURRENT_TIME 
                CURRENT_TIMESTAMP CURSOR DATABASE DATE DAY DB_KEY DEBUG DEC DECIMAL DECLARE DEFAULT
                DELETE DESC DESCENDING DESCRIBE DESCRIPTOR DISCONNECT DISPLAY DISTINCT DO DOMAIN DOUBLE DROP ECHO EDIT ELSE 
                END ENTRY_POINT ESCAPE EVENT EXCEPTION EXECUTE EXISTS EXIT EXTERN EXTERNAL EXTRACT FETCH FILE FILTER FLOAT 
                FOR FOREIGN FOUND FREE_IT FROM FULL FUNCTION GDSCODE GENERATOR GEN_ID GLOBAL GOTO GRANT GROUP GROUP_COMMIT_WAIT 
                GROUP_COMMIT_ WAIT_TIME HAVING HELP HOUR IF IMMEDIATE IN INACTIVE INDEX INDICATOR INIT INNER INPUT INPUT_TYPE 
                INSERT INT INTEGER INTO IS ISOLATION ISQL JOIN KEY LC_MESSAGES LC_TYPE LEFT LENGTH LEV LEVEL LIKE LOGFILE 
                LOG_BUFFER_SIZE LOG_BUF_SIZE LONG MANUAL MAX MAXIMUM MAXIMUM_SEGMENT MAX_SEGMENT MERGE MESSAGE MIN MINIMUM 
                MINUTE MODULE_NAME MONTH NAMES NATIONAL NATURAL NCHAR NO NOAUTO NOT NULL NUMERIC NUM_LOG_BUFS NUM_LOG_BUFFERS 
                OCTET_LENGTH OF ON ONLY OPEN OPTION OR ORDER OUTER OUTPUT OUTPUT_TYPE OVERFLOW PAGE PAGELENGTH PAGES PAGE_SIZE 
                PARAMETER PASSWORD PLAN POSITION POST_EVENT PRECISION PREPARE PROCEDURE PROTECTED PRIMARY PRIVILEGES PUBLIC QUIT 
                RAW_PARTITIONS RDB$DB_KEY READ REAL RECORD_VERSION REFERENCES RELEASE RESERV RESERVING RESTRICT RETAIN RETURN 
                RETURNING_VALUES RETURNS REVOKE RIGHT ROLE ROLLBACK RUNTIME SCHEMA SECOND SEGMENT SELECT SET SHADOW SHARED SHELL 
                SHOW SINGULAR SIZE SMALLINT SNAPSHOT SOME SORT SQLCODE SQLERROR SQLWARNING STABILITY STARTING STARTS STATEMENT 
                STATIC STATISTICS SUB_TYPE SUM SUSPEND TABLE TERMINATOR THEN TIME TIMESTAMP TO TRANSACTION TRANSLATE TRANSLATION 
                TRIGGER TRIM TYPE UNCOMMITTED UNION UNIQUE UPDATE UPPER USER USING VALUE VALUES VARCHAR VARIABLE VARYING VERSION 
                VIEW WAIT WEEKDAY WHEN WHENEVER WHERE WHILE WITH WORK WRITE YEAR YEARDAY""".split()
            
            #print 'FireBird: ',len(self.params['keywords'])
        elif self.dbmsType == 'mysql':
            self.params['table_desc'] = "ALTER TABLE %(table)s COMMENT %(desc)s"
            self.params['column_desc'] = "ALTER TABLE %(table)s MODIFY %(column)s %(type)sCOMMENT %(desc)s"
            self.params['quote_l'] = '`'
            self.params['quote_r'] = '`'
            self.params['max_id_len'] = { 'default' : 64 }
            self.params['has_auto_increment'] = True

            self.params['keywords'] = """
                ADD ALL ALTER ANALYZE AND AS ASC ASENSITIVE AUTO_INCREMENT BDB BEFORE BERKELEYDB BETWEEN BIGINT BINARY
                BLOB BOTH BY CALL CASCADE CASE CHANGE CHAR CHARACTER CHECK COLLATE COLUMN COLUMNS CONDITION CONNECTION
                CONSTRAINT CONTINUE CREATE CROSS CURRENT_DATE CURRENT_TIME CURRENT_TIMESTAMP CURSOR DATABASE 
                DATABASES DAY_HOUR DAY_MICROSECOND DAY_MINUTE DAY_SECOND DEC DECIMAL DECLARE DEFAULT DELAYED DELETE DESC
                DESCRIBE DETERMINISTIC DISTINCT DISTINCTROW DIV DOUBLE DROP ELSE ELSEIF ENCLOSED ESCAPED EXISTS EXIT 
                EXPLAIN FALSE FETCH FIELDS FLOAT FOR FORCE FOREIGN FOUND FRAC_SECOND FROM FULLTEXT GRANT GROUP
                HAVING HIGH_PRIORITY HOUR_MICROSECOND HOUR_MINUTE HOUR_SECOND IF IGNORE IN INDEX INFILE INNER INNODB
                INOUT INSENSITIVE INSERT INT INTEGER INTERVAL INTO IO_THREAD IS ITERATE JOIN KEY KEYS KILL LEADING
                LEAVE LEFT LIKE LIMIT LINES LOAD LOCALTIME LOCALTIMESTAMP LOCK LONG LONGBLOB LONGTEXT LOOP LOW_PRIORITY 
                MASTER_SERVER_ID MATCH MEDIUMBLOB MEDIUMINT MEDIUMTEXT MIDDLEINT MINUTE_MICROSECOND MINUTE_SECOND MOD NATURAL
                NOT NO_WRITE_TO_BINLOG NULL NUMERIC ON OPTIMIZE OPTION OPTIONALLY OR ORDER OUT OUTER OUTFILE PRECISION PRIMARY
                PRIVILEGES PROCEDURE PURGE READ REAL REFERENCES REGEXP RENAME REPEAT REPLACE REQUIRE RESTRICT RETURN REVOKE RIGHT
                RLIKE SECOND_MICROSECOND SELECT SENSITIVE SEPARATOR SET SHOW SMALLINT SOME SONAME SPATIAL SPECIFIC
                SQL SQLEXCEPTION SQLSTATE SQLWARNING SQL_BIG_RESULT SQL_CALC_FOUND_ROWS SQL_SMALL_RESULT SQL_TSI_DAY 
                SQL_TSI_FRAC_SECOND SQL_TSI_HOUR SQL_TSI_MINUTE SQL_TSI_MONTH SQL_TSI_QUARTER SQL_TSI_SECOND SQL_TSI_WEEK
                SQL_TSI_YEAR SSL STARTING STRAIGHT_JOIN STRIPED TABLE TABLES TERMINATED THEN TIMESTAMPADD TIMESTAMPDIFF TINYBLOB
                TINYINT TINYTEXT TO TRAILING TRUE UNDO UNION UNIQUE UNLOCK UNSIGNED UPDATE USAGE USE USER_RESOURCES USING
                UTC_DATE UTC_TIME UTC_TIMESTAMP VALUES VARBINARY VARCHAR VARCHARACTER VARYING WHEN WHERE WHILE WITH
                WRITE XOR YEAR_MONTH ZEROFILL""".split() 
            #print 'MySql: ',len(self.params['keywords'])
        elif self.dbmsType == 'postgres':
            self.params['max_id_len'] ={ 'default' : 63 },
            self.params['keywords'] = """
                ALL AND ANY AS ASC AUTHORIZATION BETWEEN BINARY BOTH CASE CAST CHECK COLLATE COLUMN CONSTRAINT CREATE
                CROSS CURRENT_DATE CURRENT_TIME CURRENT_TIMESTAMP CURRENT_USER DEFAULT DEFERRABLE DESC DISTINCT ELSE
                END EXCEPT FALSE FOR FOREIGN FREEZE FROM FULL GRANT GROUP HAVING ILIKE IN INITIALLY INNER INTERSECT
                INTO IS ISNULL JOIN LEADING LEFT LIKE LIMIT LOCALTIME LOCALTIMESTAMP NATURAL NEW NOT NOTNULL NULL 
                OFF OLD ON ONLY OR ORDER OUTER OVERLAPS PRIMARY REFERENCES RIGHT SELECT SESSION_USER SIMILAR SOME TABLE 
                THEN TO TRAILING TRUE UNION UNIQUE USER USING VERBOSE WHEN WHERE""".split()
            #print 'Postgres: ',len(self.params['keywords'])
        
        
        #For reference here are the list of keywords for a real language -- python (case sensitive too):
        python_kwds = """and del for is raise assert elif from lambda return break else global not try class except if or while    
            continue exec import pass yield def finally in print""".split()
        #print 'Python:', len(python_kwds)


    def retColDefs(self, doc, strPreDdl, strPostDdl):
        colDefs = []
        strTableName = doc.getAttribute('name')
        cols = doc.getElementsByTagName('column')
        for col in cols:
            colDefs.append(self.retColumnDefinition(col, strPreDdl, strPostDdl))
        
        return colDefs
    
    def retColumnDefinition(self, col, strPreDdl, strPostDdl):
        strColName = col.getAttribute('name')
        
        strRet = self.quoteName(strColName) + ' ' + self.getColType(col)
        
        if col.hasAttribute('null') and re.compile('not|no', re.IGNORECASE).match(col.getAttribute('null')):
            strRet += ' NOT NULL'
        
        if col.hasAttribute('default'):
            strRet += ' DEFAULT ' + col.getAttribute('default')
        elif self.dbmsType == 'mysql' and col.getAttribute('type') == 'timestamp':
            # MySQL silently sets the default to CURRENT_TIMESTAMP
            strRet += ' DEFAULT null'
        
        if col.hasAttribute('autoincrement') and col.getAttribute('autoincrement').lower() == "yes":
            strRet += self.addAutoIncrement(col, strPreDdl, strPostDdl)

        return strRet
    
    def getSeqName(self, strTableName, strColName):
        return '%s_%s_seq' % (strTableName, strColName)
    
    def getAiTriggerName(self, strTableName, strColName):
        return 'ai_%s_%s' % (strTableName, strColName)
    
    def addAutoIncrement(self, col, strPreDdl, strPostDdl):
        strTableName = col.parentNode.parentNode.getAttribute('name')
        
        info = {
            'table_name' : strTableName,
            'col_name'   : col.getAttribute('name'),
            'seq_name'   : self.getSeqName(strTableName, col.getAttribute('name')),
            'ai_trigger' : self.getAiTriggerName(strTableName, col.getAttribute('name')),
        }
        
        if self.params['has_auto_increment']:
            return ' AUTO_INCREMENT'
    
        if self.dbmsType == 'firebird':
            strPreDdl.append(('autoincrement generator',
                'CREATE GENERATOR %(seq_name)s' % info))
            strPostDdl.append(('autoincrement trigger',
                """CREATE TRIGGER %(ai_trigger)s FOR %(table_name)s
                BEFORE INSERT AS
                BEGIN
                    NEW.%(col_name)s = GEN_ID(%(seq_name)s, 1);
                END""" % info))
            return ''
        
        strPreDdl.append(('autoincrement', 
            'CREATE SEQUENCE %(seq_name)s' % info))
            
        if col.getAttribute('default'):
            print "Error: can't have a default and autoincrement together"
            return ''
            
        return " DEFAULT nextval('%(seq_name)s')" % info
        
    def getColType(self, col):
        strColType = col.getAttribute('type')
        nSize = None
        if col.hasAttribute('precision'):
            nSize = int(col.getAttribute('size'))
            nPrec = int(col.getAttribute('precision'))
            strRet = '%s(%d, %d)' % (strColType, nSize, nPrec)
        elif col.hasAttribute('size'):
            nSize = int(col.getAttribute('size'))
            strRet = '%s(%d)' % (strColType, nSize)
        else:
            strRet = '%s' % (strColType)
        
        return strRet
        
    def retKeys(self, doc):
        columns = doc.getElementsByTagName('column')
        keys = []
        for column in columns:
            if column.hasAttribute('key'):
                keys.append(column.getAttribute('name'))
        
        return keys

    def addRelations(self, doc):
        if not self.params['output_references']:
            return
            
        relations = doc.getElementsByTagName('relation')
        strTableName = doc.getAttribute('name')
        
        for relation in relations:
            self.addRelation(strTableName, relation)
        

    def addRelation(self, strTableName, relation):
        info = {
            'tablename'  : self.quoteName(strTableName),
            'thiscolumn' : self.quoteName(relation.getAttribute('column')),
            'othertable' : self.quoteName(relation.getAttribute('table')),
            'constraint' : self.quoteName(self.getRelationName(relation)),
            'ondelete' : '',
            'onupdate' : '',
        }
        if relation.hasAttribute('fk'):
            info['fk'] = relation.getAttribute('fk')
        else:
            info['fk'] = info['thiscolumn']
        
        if relation.hasAttribute('ondelete'):
            action = relation.getAttribute('ondelete').upper()
            if action == 'SETNULL':
                action = 'SET NULL'
            info['ondelete'] = ' ON DELETE ' + action
        
        if relation.hasAttribute('onupdate'):
            action = relation.getAttribute('onupdate').upper()
            if action == 'SETNULL':
                action = 'SET NULL'
            info['onupdate'] = ' ON UPDATE ' + action
            
        self.ddls.append(('relation', 
            'ALTER TABLE %(tablename)s ADD CONSTRAINT %(constraint)s FOREIGN KEY (%(thiscolumn)s) REFERENCES %(othertable)s(%(fk)s)%(ondelete)s%(onupdate)s' % info))

    def getRelationName(self, relation):
        strConstraintName = relation.getAttribute('name')
        if len(strConstraintName) == 0:
            strConstraintName = "fk_%s" % (relation.getAttribute('column'))

        return strConstraintName
    
    def addIndexes(self, doc):
        if not self.params['output_indexes']:
            return
            
        strTableName = doc.getAttribute('name')
        indexes = doc.getElementsByTagName('index')
        for index in indexes:
            self.addIndex(strTableName, index)

    def addIndex(self, strTableName, index):
        strColumns = index.getAttribute("columns")
        strIndexName = self.getIndexName(strTableName, index)
        cols = strColumns.split(',')
        cols = index.getAttribute("columns").split(',')
        cols = [self.quoteName(col) for col in cols]
        
        self.ddls.append(('Add Index',
            'CREATE INDEX %s ON %s (%s)' % (self.quoteName(strIndexName), self.quoteName(strTableName), ', '.join(cols)) ))
    
    def getIndexName(self, strTableName, index):
        strIndexName = index.getAttribute("name")
        if strIndexName and len(strIndexName) > 0:
            return strIndexName
        
        cols = index.getAttribute("columns").split(',')
        cols = [ self.quoteName(col.strip()) for col in cols ] # Remove spaces
        
        strIndexName = "idx_" + strTableName + '_'.join([col.strip() for col in cols])
        
        return strIndexName
        
    def col2Type(self, doc):
        ret = {}
        for col in doc.getElementsByTagName('column'):
            strColName = col.getAttribute('name')
            strType = col.getAttribute('type')
            ret[strColName] = strType
        
        return ret
        
    def addDataset(self, doc):
        if not self.params['add_dataset']:
            return
        
        strTableName = doc.getAttribute('name')
        
        datasets = doc.getElementsByTagName('val')
        
        col2Type = self.col2Type(doc)
        
        for dataset in datasets:
            cols = []
            vals = []
            attribs = dataset.attributes
            for nIndex in range(attribs.length):
                strColName = attribs.item(nIndex).name
                strColValue = attribs.item(nIndex).value
                
                cols.append(strColName)
                
                strType = col2Type[strColName].lower()
                if strType == 'varchar' or strType == 'char':
                    # TODO: do more types
                    vals.append("%s" % (self.quoteString(strColValue)))
                else:
                    vals.append(strColValue)
            
            self.ddls.append(('dataset',
                'INSERT INTO %s (%s) VALUES (%s)' % (self.quoteName(strTableName), ', '.join(cols), ', '.join(vals))))
        
    def createTable(self, doc):
        strTableName = self.quoteName(doc.getAttribute('name'))
        
        if self.params['drop-tables']:
            self.ddls.append(
                ('Drop table', 'DROP TABLE %s' % (strTableName)))
        
        strPreDdl = []
        strPostDdl = []
        colDefs = self.retColDefs(doc, strPreDdl, strPostDdl)
        
        self.ddls += strPreDdl
        
        keys = self.retKeys(doc)
        strTableStuff = ''
        if len(keys) > 0:
            strPrimaryKeys = ',\n\tCONSTRAINT pk_%s PRIMARY KEY (%s)' % (strTableName, ',\n\t'.join(keys))
        else:
            strPrimaryKeys = '\n'
        
        if self.dbmsType == 'mysql':
            strTableStuff += ' ENGINE=InnoDB'
        if doc.hasAttribute('desc') and self.dbmsType == 'mysql':
            strTableStuff += " COMMENT=%s" % (self.quoteString(doc.getAttribute('desc')))
        
        self.ddls.append(
            ('Create Table', 'CREATE TABLE %s (\n\t%s%s)%s' % (strTableName, ',\n\t'.join(colDefs), strPrimaryKeys, strTableStuff)))

        self.ddls += strPostDdl

        if doc.hasAttribute('desc'):
            self.addTableComment(strTableName, doc.getAttribute('desc'))
            
        self.addColumnComments(doc)
        self.addIndexes(doc)
        self.addRelations(doc)
        self.addDataset(doc)
    
    def addTableComment(self, tableName, desc):
        """ TODO: Fix the desc for special characters """
        info = {
            'table' : tableName,
            'desc' : self.quoteString(desc),
        }
        self.ddls.append(('Table Comment',
            self.params['table_desc'] % info ))

    def addColumnComments(self, doc):
        """ TODO: Fix the desc for special characters """
        strTableName = doc.getAttribute('name')
        
        for column in doc.getElementsByTagName('column'):
            if column.hasAttribute('desc'):
                self.addColumnComment(column, strTableName, column.getAttribute('name'), column.getAttribute('desc'))

    def addColumnComment(self, col, strTableName, strColumnName, strDesc):
        info = {
            'table' : strTableName,
            'column' : strColumnName,
            'desc' :  self.quoteString(strDesc),
            'type' : self.getColType(col) + ' ',
        }
        self.ddls.append(('Column comment',
            self.params['column_desc'] % info ))

    def createTables(self, xml):
        self.ddls = []
        
        # Should double check here that there is only one table.
        tbls = xml.getElementsByTagName('table')
        
        for tbl in tbls:
            self.createTable(tbl)
            
        xml.unlink()
        return self.ddls

    def quoteName(self, strName):
        bQuoteName = False
        
        if not self.params['unquoted_id'].match(strName):
            bQuoteName = True

        if strName.upper() in self.params['keywords']:
            bQuoteName = True
        
        if not bQuoteName:
            if strName[0] == '"' and strName[-1] == '"':
                # Already quoted.
                bQuoteName = False

        if bQuoteName:
            return self.params['quote_l'] + strName + self.params['quote_r']
        
        return strName

    def quoteString(self, strStr):
        return "'%s'" % (strStr.replace("'", "''"))
    
def readDict(dictionaryNode):
    dict = {}
    for adict in dictionaryNode.getElementsByTagName('dict'):
        strClass = adict.getAttribute('class')
        if strClass in dict:
            newDict = dict[strClass]
        else:
            newDict = {}
        
        attrs = adict.attributes
        for nIndex in range(attrs.length):
            strName = attrs.item(nIndex).name
            strValue = attrs.item(nIndex).value
            
            if strName == 'class':
                # Skip the class
                continue
            elif strName == 'inherits':
                # Merge in the inherited values (multiple inheritance supported with comma
                classes = strValue.split(',')
                for aClass in classes:
                    if aClass not in dict:
                        print "class '%s' not found in dictionary" % (aClass)
                    else:
                        for key, val in dict[str(aClass)].items():
                            if key not in newDict:
                                newDict[key] = val
            else:
                newDict[str(strName)] = str(strValue)
                
        dict[str(strClass)] = newDict
    
    return dict

def readMergeDict(strFilename):
    ret = parse(strFilename)
    
    handleIncludes(ret)
    
    handleDictionary(ret)
    
    return ret

def handleIncludes(ret):
    includes = ret.getElementsByTagName('include')
    if not includes:
        return
    
    for include in includes:
        strHref = include.getAttribute('href')
        print "Including", strHref
        new = None
        try:
            new = parse(strHref)
        except Exception, e:
            print e
            
        if not new:
            print "Unable to include '%s'" % (strHref)
            continue
        
        include.parentNode.insertBefore(new.documentElement.firstChild.nextSibling, include)
        # I could delete the <include> node, but why bother?
        
    
def handleDictionary(ret):
    dictionaries = ret.getElementsByTagName('dictionary')
    if not dictionaries:
        return
    
    for aNode in dictionaries:
        strReplaceNodes = aNode.getAttribute('name')
        
        dict = readDict(aNode)
    
        for column in ret.getElementsByTagName(str(strReplaceNodes)):
            strClass = column.getAttribute('class')
            if not strClass:
                continue
            
            if strClass in dict:
                # Merge in the attributes
                for key, val in dict[strClass].items():
                    # Don't blow away already existing attributes
                    if not column.hasAttribute(key):
                        column.setAttribute(key, val)
            else:
                print "Error class name not found '%s'" % (strClass)
    
    
if __name__ == "__main__":
    import optparse
    parser = optparse.OptionParser()
    parser.add_option("-d", "--drop",
                  action="store_true", dest="bDrop", default=True,
                  help="Drop Tables")
    parser.add_option("-b", "--dbms",
                  dest="strDbms", metavar="DBMS", default="postgres",
                  help="Output for which Database System")
                  
    (options, args) = parser.parse_args()

    cd = Xml2Ddl()
    cd.setDbms(options.strDbms)
    cd.params['drop-tables'] = options.bDrop
    
    strFilename = args[0]
    xml = readMergeDict(strFilename)
    results = cd.createTables(xml)
    for result in results:
        print "%s;" % (result[1])
    
