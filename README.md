<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<!-- <img src="https://ibb.co/8sMncnt" ></img> -->
<div align="center">
<img src="https://github.com/cvang9/issue-tracker/blob/main/ER_Diagram%20(ITS).png" align="center" alt="ER-Diagram-ITS"  />
</div>

#  Issue Tracking System


Clone repo: 
```sh
git clone https://github.com/cvang9/issue-tracker.git
```

# Features

###  Authentication

- In order to utilise the application one must have to login.
- Users can create thier personal account by signing up or can directly login if they had already created an account.
- Resolvers can take thier credentials from Admin then after they can login into the system.
- Application developers provide admin creds to admin through which admin can login into the system. 


###  Authorization

- Users, Resolvers, Admin are only allowed to fetch the data which is related to them only.

- The Access Control is maintained in the backend using Gates and in the frontend using Navigation Guards. Still if anyone try to access unauthorized page then they will be redirected to thier respective page according to thier role.


###  User  

- User on its dashboard can able to check thier ticket status whether it is still pending, processing, resolved or rejected.

- User can navigate to any category easily by utilising the Navigation buttons at the top.

- Flexibility to choose the department from the list where user thinks that the issue is belongs to.

- The tickets categories are distributed on the basis of colors.
   Green represents Resolved, Red represents Rejected, Blue represents Processing and Yellow represents Pending.

- For all categories other then pending users can see a response feedback sent by resolver regarding thier ticket. 

- User will recieve mail regarding the updates of thier tickets if any resolver has updated your ticket.

- User will get a chat session mail if resolver needs more information regarding the issue, where user can directly redirected to the chat page via the start chat button in the mail.
 


###  Multifunctional Resolver 

- Resolver on thier dashboard can see a lot of options like in the side bar resolver can navigate to all types of ticket categories.  For ex: if resolver clicks to Resolved tickets then he can able to see all the resolved tickets that belongs to same department of resolver.   

- After selecting a particular ticket resolver can see the details regarding the issue with a short title and description, as well as details of user like username and email.

- On the ticket dashboard resolver can update the ticket status to processing, resolved, rejected with a feedback regarding the update.

- On updating the status of ticket a mail is automatically is sent to the respective user.

- Also if resolver is required for more information regarding the issue then resolver can schedule a chat session whith user by providing date and time in the input box. 

- On scheduled time resolver can start an instant chat with user, also the chat history will be maintained in the database.

- Resolver will be notified on mail if any new ticket is raised that belongs to same department of resolver.

- Resolver also can visit thier profile and check thier overall status and analyse itself using the statistics.


###  Admin 

- Admin on thier dashboard can see the overall tickets statistics regarding the tickets like: no. of pending tickets, no. of resolved tickets, no. of processing tickets, and no of rejected tickets.

- Along with this user can see the net of users, resolvers and departments on the dashboard.

- Below that Admin can see two graphs that compares resolved tickets vs Raised tickets. The first graph is on the basis of current year and second one is on the basis of current week. 

- Admin has powers to create Resolver as well as department on top of the system.

- In the Tables section admin can view two lists. The first list is department list which displays all department with thier total count of issue raised, resolved, rejected and processing. Whereas  the second list belongs to resolver which displays the information regarding the resolver like no of issues resolved, processed and rejected.

- With these admin can control the whole system seamlessly.

- Admin will get a small notification icon in its navbar which will contains the latest 5 updates of system. 

### Extra backend features 

- Caching
- Mail Notifications using Queue
- Asyncronous execution using Queue
- Web Sockets For realtime chat
- Authentication
- Authorization
- Test cases



### Extra frontend features 

- SPA
- Dark mode for Resolver and Admin
- Composition API
- Pinia store for state management
- Navigation guards
- Test cases



### Contributors
 - Shivang Saini
- Shivam Teotia
- Nakshatra
