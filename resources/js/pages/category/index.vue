<template>
  <div>

    <v-card color="grey lighten-2">
      <div class="justify-space-around d-flex">
       <v-card-title>Cafe Badilico</v-card-title>
       <v-card-title>
         <v-btn
        outlined
        rounded
        color="primary"
      >
        Create Category
      </v-btn>
         </v-card-title>
      </div>
    </v-card>

    <v-simple-table>
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left">
              ID
            </th>
            <th class="text-left">
              Name
            </th>
            <th class="text-left">
              slug
            </th>
            <th class="text-left">
              Action
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="item in desserts"
            :key="item.name"
          >
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.slug }}</td>
            <td>
              <v-btn
                depressed
                color="primary"
              >
                Edit
              </v-btn>
              <v-btn
                depressed
                color="error"
              >
                Delete
              </v-btn>
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </div>
</template>


<script>
  export default {
    data () {
      return {
        desserts: [
          {
            id: 1,
            name: 'Frozen Yogurt',
            slug: 'fashion',
          },
          {
            id: 2,
            name: 'Frozen Yogurt',
            slug: 'fashion',
          },
          {
            id: 3,
            name: 'Frozen Yogurt',
            slug: 'fashion',
          },
          {
            id: 4,
            name: 'Frozen Yogurt',
            slug: 'fashion',
          },
        ],
      }
    },
  }
</script>