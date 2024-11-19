# An anonymous chat application written in PHP.

## Sample users table -->

```
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,          
    username VARCHAR(255) NOT NULL UNIQUE,      
    password VARCHAR(255) NOT NULL,             
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP 
);
```

## Sample message table -->

```
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,          
    content TEXT NOT NULL,                      
    posted_by VARCHAR(255) NOT NULL,            
    ip_address VARCHAR(45) NOT NULL,            
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP, 
    user_id INT NOT NULL,                       
    mac_address VARCHAR(17) NOT NULL            
);

```


