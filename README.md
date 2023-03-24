## Planned features

Features:
- [x] register
- [x] login
- [x] logout
- [ ] add task
- [ ] list tasks
- [ ] delete task
- [ ] modify task
- [ ] mark todo item as completed
- [ ] add note to todo item
- [ ] search items
- [ ] set due date
- [ ] set up personal API key
- [ ] revoke personal API key


REST API:
- [ ] list tasks
- [ ] create task 
- [ ] delete task
- [ ] modify task
- [ ] resolve task

Others:
- [ ] email notifications about tasks with due date set for today

### Testing

#### Unit testing

```bash 
$ bin/phpunit tests/unit
```

#### Integration tests

> Make sure, that `test` environment is independent of any other environments, as all data will be removed!

```bash
$ bin/console doctrine:fixtures:load -n -e test
$ bin/phpunit tests/application
```