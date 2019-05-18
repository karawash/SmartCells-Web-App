## SmartCells

SmartCells is a web interface for intelligent distributed system under development. 
It is mainly based on building a standard center of instructions for Cloud Web services, 
known as a Cloud Brain. It is	capable to serve intelligently any type of
request given by other machines (commanders) based on the Cells collaboration properties.


Through the above code SmartCells proves two Cell properties: availability and security.
Each Cell provide on kind of service, and keep tracking the availability of all the cloud 
web service that are under its role. When a commander machine ask to process a job, Cell could
use the most available web service from the cloud to perform the job. It can collaborate with
other Cells if the task require different kind of web service. Also, Cells can ensure secure
handle of task via showing details about the job execution. This is proved above using the anonymous email
example. Instead of recieving random emails with knowing the source, Cells provide the details about the 
overall context profile of the sender (like: location, real ip, ...).
