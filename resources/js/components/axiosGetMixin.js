export default {
  data () {
    return {
      fetchState: {
        isFetching: false,
        isError: false
      }
    }
  },
  methods: {
    axiosGet (url, params) {
      // eslint-disable-next-line no-async-promise-executor
      return new Promise(async (resolve, reject) => {
        try {
          this.fetchState.isFetching = true
          const response = await axios.get(`/api/${url}`, { params })

          if (response.status !== 200) {
            this.fetchState.isError = true
            return
          }

          resolve(response.data)
        } catch (error) {
          this.fetchState.isError = true
        } finally {
          this.fetchState.isFetching = false
        }
      })
    }
  }
}
