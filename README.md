HyperMVC
========

Small MVC library for fast prototype staging or setting up small dynamic pages or apps 

<p style="padding: 5px; border: 1px solid #ccc; border-radius: 3px; background-color: #d9edf7;">This is a small codeiginter like "framework" following MVC programing paradigm. It's primary purpose is to help setting up small staging examples that we use in creating prototypes of web applications and/or dynamic websites, or it can be used to quickly set up basic ground for a MVC like application. Idea was to eliminate the need to rewrite same kind of router, database wrapper and view classes over and over again, and yet to avoid big footprints and complexities that standard frameworks have.</p>
<p style="padding: 5px; border: 1px solid #ccc; border-radius: 3px; background-color: #f2dede;"><b>Warning:</b> If used in production environment, keep in mind there is work to be done! There are no security checks when inputing data, except standard PDO injection protection and no error handling for various states. They will be or will not be integrated in the future.</p> 			
<p style="padding: 5px; border: 1px solid #ccc; border-radius: 3px; background-color: #d9edf7;">There are some examples for basic controller, model, view setup. Browse the file structure! Everything should be configured in the config folder</p>