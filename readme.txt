edit 

in ajax_image_upload /index
http://localhost:88

opent pacs
dictate file

pdf use tcpdf

for remove br in dicated

$TEXTREPORT = preg_replace('#<br\s*/?>#i', "\.br\ ", $TEXTREPORT);


-------------------------------
DCM4CHEE
-------------------------------
'study_iuid' cannot be null
''req_proc_id' cannot be null'


ZDS|1.2.4.0.13.1.432252867.1552647.1^100^Application^DICOM

ZDS|1.2.840.113754.1.4.141.6889370.9079.1.141.62911.3432^VISTA^Application^DICOM

ZDS|1.2.840.113754.1.4.141.6889370.907.1.141.62911.3433^VISTA^Application^DICOM

<xsl:variable name="suid-prefix" select="'1.2.4.0.13.1.432252867.'"/>

As I observed, Study Instance UID is must for creating modality worklist items in dcm4chee. In case of missing Study Instance UID in the in-bound HL7 ORM message, you can modify the HL7 to DICOM mapping file (orm2dcm) to generate unique and valid Study Instance UIDs from the supplied procedure step ids.

For this, you can refer the sample orm2dcm files used by the vendors, copied in server/default/conf/dcm4chee-hl7 folder.
--------------------------------