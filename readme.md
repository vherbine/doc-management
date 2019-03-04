## Challenge

Create a web application based on PHP + MySQL stack (free to add framework of choice on top of that) with following functionalities: 
 
1. Allows you to store a set of key/value pairs of different types (strings, numbers, dates) as documents 
2. When saving a document, it should also store some metadata:     
* date when document was created     
* date when document was last modified     
* date when document was last exported 
3. Allows you to list all documents stored along with all metadata fields 
4. Allows you to update values for existing document by their key 
5. When updating document it updates metadata of last modification date 
6. Allows you to delete document 
7. Allows you to export stored document for download as a comma separated text file with columns being: “key” and “value”. It should also contain “creation date” and “last update date” in it’s first line, before headings and list of fields. 
8. Allows you to export stored document in the same CSV format to a 3rd party cloud storage service of your choice. Exporting the file should return publicly accessible URL to that file. 
9. Exposes all above functionality over the RESTful web interface 
 
While building the application please design your solution thinking about future iterations being: 
 
1. Ability to export to different document formats (XLS, PDF) 
2. Ability to export to other 3rd party cloud storage service (like AWS S3, Dropbox, OneDrive etc.) 
3. Ability to add more metadata, for example information about the IP address document was created from 
4. Ability to customize exported file by passing date format as an argument to the export call, which should end up formatting all the date fields properly 

● Important: Those future iterations requirements don’t need to be implemented within this project, but should be taken account when planning your architecture and designing solution. We’d ask you to walk us through later on how would you implement those additions. 
 
