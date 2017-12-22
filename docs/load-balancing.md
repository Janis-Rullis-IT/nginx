# Load balancing

## Resources


## Algorithms

### Round robin
Servers are connected in a circle. A new request goes to the next server in line. 
* Skips a server which is down.
* Does not cares about that servers load. It can be very loaded.

### Least connected

### Fastest response

### IP hash
Based on IP.

### Generic hash
The server to which a request is sent is determined from a user-defined key which may be a text, variable, or their combination.

## Options

### Sticky session
* A client can be hooked to one server based on client's session. Works for all balancing types.

### Slow start
The server slow start feature prevents a recently recovered server from being overwhelmed by connections, which may timeout 
and cause the server to be marked as failed again.
