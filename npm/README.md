DIRECTORY STRUCTURE
-------------------

      lib/          dependancies loaded globally (shim js, bootstrap js and scss)
      src/          application root config js and scss
      src/redux/    redux store, actions and reducers      
      src/routes/   url route components (loaded in src/App.js)

GULP FILE
---------

```
# build lib/ files and production version src/ files
npm run gulp prod
```

```
# build development version src/ files
npm run gulp prod
```

```
# build development version src/ files when files are changed
npm run gulp watch
```

```
# build individual gulp tasks
npm run gulp <task-name>
```

### Gulp tasks

clean, reload-browser, build-dev-js, build-prod-js, build-bootstrap-sass,

move-bootstrap-fonts, build-dev-sass, build-prod-sass, move-images, 

default, dev, prod, watch
