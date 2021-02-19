import * as React from "react";
import {
  View,
  Text,
  RefreshControl,
  ActivityIndicator,
  StyleSheet,
} from "react-native";
import * as SQLite from "expo-sqlite";
import { createStackNavigator } from "@react-navigation/stack";
import { ScrollView, FlatList, Image } from "react-native";
import { TouchableOpacity } from "react-native-gesture-handler";
import Pagamento from "../screens/Pagamento";

const Stack = createStackNavigator();
const db = SQLite.openDatabase("dbapploja.banco");

let idpro = 0;

export default function Carrinho() {
  //Vamos criar ou abrir o banco de dados relacionado ao carrinho

  return (
    <Stack.Navigator>
      <Stack.Screen name="Itens no Carrinho" component={ItensCarrinho} />
      <Stack.Screen name="Pagamento" component={Pagamento} />
    </Stack.Navigator>
  );
}

const wait = (timeout) => {
  return new Promise((resolve) => {
    setTimeout(resolve, timeout);
  });
};

function ItensCarrinho({ navigation }) {
  const [produtos, setProdutos] = React.useState([]);
  const [carregando, setCarregando] = React.useState(true);

  const [refreshing, setRefreshing] = React.useState(false);

  //condificação de atualização dos controles de tela

  const onRefresh = React.useCallback(() => {
    setRefreshing(true);
    db.transaction((tx) => {
      tx.executeSql("select * from carrinho", [], (_, { rows: { _array } }) => {
        setProdutos(_array);
      });
    });
    wait(2000).then(() => setRefreshing(false));
  }, []);

  React.useEffect(() => {
    db.transaction((sl) => {
      sl.executeSql("select * from carrinho", [], (_, { rows }) => {
        //console.log(JSON.stringify(rows._array));
        setProdutos(rows._array);
        setCarregando(false);
      });
    });
  }, []);

  return (
    <ScrollView
      horizontal={false}
      style={styles.scrollview}
      refreshControl={
        <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
      }
    >
      {carregando ? (
        <ActivityIndicator />
      ) : (
        <FlatList
          data={produtos}
          renderItem={({ item }) => (
            <View>
              <Text style={styles.txtCarrinho}>
                Nome do Produto: {item.nomeproduto}{" "}
              </Text>
              <Text style={styles.txtCarrinho2}>Preço: R$ {item.preco} </Text>
              <TouchableOpacity
                onPress={() => {
                  db.transaction((tx) => {
                    tx.executeSql("delete from carrinho where idproduto=?", [
                      item.idproduto,
                    ]);
                    alert("Item excluído");
                  });
                }}
              >
                <Text style={styles.btnRemover}>Remover do Carrinho</Text>
              </TouchableOpacity>
            </View>
          )}
          keyExtractor={({ id }, index) => id}
        />
      )}

      <TouchableOpacity
        onPress={() => {
          navigation.navigate("Pagamento");
        }}
        style={styles.btnPagamento}
      >
        <Text>Efetuar Pagamento</Text>
      </TouchableOpacity>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  scrollview: {
    flex: 1,
    alignContent: "center",
    marginTop: 20,
    backgroundColor: "#73eeee",
  },
  btnApagar: {
    padding: 10,
    backgroundColor: "darkred",
    margin: 5,
  },
  txtApagar: {
    color: "white",
  },
  txtCarrinho: {
    marginTop: 20,
    marginLeft: 5,
  },
  txtCarrinho2: {
    marginLeft: 5,
  },
  btnPagamento: {
    marginTop: 30,
    paddingVertical: 5,
    borderWidth: 4,
    borderRadius: 6,
    backgroundColor: "#61dafb",
    textAlign: "center",
    fontSize: 30,
    fontWeight: "bold",
    marginLeft: 30,
    padding: 15,
    marginRight: 170,
  },
  btnRemover: {
    marginTop: 10,
    fontWeight: "bold",
    padding: 5,
    borderColor: "#20232a",
    borderWidth: 4,
    paddingVertical: 8,
    textAlign: "center",
    marginLeft: 5,
    marginRight: 5,
    backgroundColor: "#ff6666",
  },
});
