import * as React from "react";
import {
  Alert,
  Modal,
  ImageBackground,
  StyleSheet,
  TouchableHighlight,
  TouchableOpacity,
  View,
  Text,
  ActivityIndicator,
} from "react-native";
import { host } from "../config/host";
import { createStackNavigator } from "@react-navigation/stack";
import { ScrollView, FlatList, Image } from "react-native";

import * as SQLite from "expo-sqlite";

const Stack = createStackNavigator();

export default function Home() {
  //vamos empilhar as 2 telas relacionadas aos
  //produtos. Começamos com a tela de ListarProdutos
  //e vamos para a tela de Detalhes
  return (
    <Stack.Navigator>
      <Stack.Screen
        name="ListarProdutos"
        component={ListarProdutos}
        options={{ headerShown: false }}
      />
      <Stack.Screen name="Detalhes do Produto" component={DetalhesProduto} />
    </Stack.Navigator>
  );
}
function ListarProdutos({ navigation }) {
  const [carregado, setCarregado] = React.useState(true);
  const [info, setDados] = React.useState([]);

  React.useEffect(() => {
    fetch(
      "http://10.26.45.45/GabrielBengoa/Loja/service/produto/listartelainicial.php"
    )
      .then((response) => response.json())
      .then((produto) => {
        setDados(produto.saida);
        console.log(produto.saida);
        console.log("======================================");
        console.log(info);
      })
      .catch((erro) => console.error(`Erro ao tentar carregar a api ${erro}`))
      .finally(() => setCarregado(false));
  }, []);

  return (
    <View style={{ flex: 1 }}>
      <ImageBackground
        source={require("../assets/images/fundo.png")}
        style={styles.imgBackground}
      >
        <ScrollView
          style={styles.scrollview}
          horizontal={true}
          contentContainerStyle={{ flex: 1 }}
        >
          {/* <Image 
       source={{uri:host+"edilson/loja/img/monitor1.png"}}
       style={styles.foto}/> */}

          {/* Criação da estrutura de lista de dados que vem da api. Vamos usar
        o comando FlatList para construir a lista.
        Até que a lista seja totalmente carregada iremos ver em tela uma animação
        de um circulo girando realizando o carregamento dos dados. Essa animação é
        feita com o comando ActivityIndicator
         */}

          {carregado ? (
            <ActivityIndicator />
          ) : (
            <FlatList
              data={info}
              renderItem={({ item }) => (
                <View>
                  <Image
                    source={{
                      uri: `http://10.26.45.45/GabrielBengoa/Loja/img/${item.foto}`,
                    }}
                    style={styles.fotoProduto}
                  />
                  <Text style={styles.txtProduto}>
                    Nome: {item.nomeproduto}
                  </Text>
                  <Text style={styles.txtProduto}>Preco: {item.preco}</Text>

                  <TouchableOpacity
                    onPress={() => {
                      navigation.navigate("Detalhes do Produto", {
                        idproduto: `${item.idproduto}`,
                      });
                    }}
                    style={styles.abrirDetalhe}
                  >
                    <Text style={styles.txtAbrirDetalhe}> Saiba mais </Text>
                  </TouchableOpacity>
                </View>
              )}
              keyExtractor={({ idproduto }, index) => idproduto}
            />
          )}
        </ScrollView>
      </ImageBackground>
    </View>
  );
}

function DetalhesProduto({ route }) {
  //Vamos criar ou abrir o banco de dados relacionado ao carrinho
  const db = SQLite.openDatabase("dbapploja.banco");

  const { idproduto } = route.params;

  const [produto, setProduto] = React.useState([]);
  const [carregando, setCarregando] = React.useState(true);

  React.useEffect(() => {
    fetch(
      `http://10.26.45.45/GabrielBengoa/Loja/service/produto/detalheproduto.php?idproduto=${idproduto}`
    )
      .then((response) => response.json())
      .then((valores) => setProduto(valores.saida))
      .catch((erro) => console.error(`Erro ao ler a api ${erro}`))
      .finally(() => setCarregando(false));
  }, []);
  return (
    <View style={{}}>
      {carregando ? (
        <ActivityIndicator />
      ) : (
        <FlatList
          data={produto}
          renderItem={({ item }) => (
            <View style={{ backgroundColor: "#99ff33" }}>
              <Text style={{ marginLeft: 6, marginTop: 8 }}>
                Nome do Produto: {item.nomeproduto}
              </Text>
              <Text style={{ marginLeft: 6 }}>Descricao: {item.descricao}</Text>
              <Text style={{ marginLeft: 6 }}>Preço: R$ {item.preco}</Text>

              <TouchableOpacity
                onPress={() => {
                  //Vamos criar/abrir a tabela com o
                  //comando abaixo e inserir os dados
                  //do carrinho de compras
                  db.transaction((tx) => {
                    tx.executeSql(
                      "create table if not exists carrinho(id integer primary key,idproduto int,nomeproduto text,preco text,foto text);"
                    );
                  });

                  //Após a crição ou abertura da tabela carrinho
                  //o produto será inserido na tabela a fim
                  //de adicioná-lo ao carrinho e posteriormente
                  //realizar o fechamento da compra
                  db.transaction((ct) => {
                    ct.executeSql(
                      "insert into carrinho(idproduto,nomeproduto,preco,foto)values(?,?,?,?)",
                      [item.idproduto, item.nomeproduto, item.preco, item.foto]
                    );
                  });

                  db.transaction((sl) => {
                    sl.executeSql(
                      "select * from carrinho",
                      [],
                      (_, { rows }) => {
                        console.log(JSON.stringify(rows));
                      }
                    );
                  });

                  /*
            O comando abaixo realiza a exclusão da tabela carrinho
            */
                  //db.transaction((gx) => {
                  //gx.executeSql("drop table carrinho");
                  //});
                }}
                style={styles.addCarrinho}
              >
                <Text style={styles.txtAddCarrinho}>Adicionar ao Carrinho</Text>
              </TouchableOpacity>
            </View>
          )}
          keyExtractor={({ idproduto }, index) => idproduto}
        />
      )}
    </View>
  );
}

const styles = StyleSheet.create({
  abrirDetalhe: {
    padding: 10,
    backgroundColor: "red",
    margin: 10,
    marginRight: 200,
  },
  txtAbrirDetalhe: {
    color: "white",
    fontSize: 15,
    textAlign: "center",
  },
  scrollview: {
    flex: 1,
    marginTop: 10,
    width: "100%",
    flexGrow: 1,
  },
  imgBackground: {
    flex: 1,
    resizeMode: "cover",
    justifyContent: "center",
  },
  foto: {
    width: "100%",
    height: 50,
  },
  addCarrinho: {
    width: 150,
    backgroundColor: "#ff0000",
    padding: 5,
    margin: 10,
  },
  txtAddCarrinho: {
    fontSize: 12,
    fontWeight: "bold",
    textAlign: "center",
  },
  fotoProduto: {
    width: 200,
    height: 200,
    resizeMode: "cover",
    marginTop: 52,
    marginLeft: 5,
  },
  txtProduto: {
    marginLeft: 5,
    color: "white",
  },
});

/*
    Criando 2 constantes para visualizar ou não o modal
    Estamos iniciado o modal com visible false, isso faz
    com que a tela de modal não apareça. Essa tela irá
    aparecer quando o comando setModalVisible for true.

    const [modalVisible, setModalVisible] = React.useState(false);

    Abaixo o comando useEffect é chamado sempre a tela, 
    neste caso a tela Home, for chamada pela primeira vez.
    O corpo do comando executa setModalVisible aplicando 
    o valor true. Isso faz a tela de modal aparecer.

    React.useEffect(()=>{
        setModalVisible(true)
    },[])

    return(
        <View style={styles.centeredView}>
        <Modal
          animationType="slide"
          transparent={true}
          visible={modalVisible}
          onRequestClose={() => {
            Alert.alert('Modal has been closed.');
          }}>
          <View style={styles.centeredView}>
            <View style={styles.modalView}>
              <Text style={styles.modalText}>Hello World!</Text>
  
              <TouchableHighlight
                style={{ ...styles.openButton, backgroundColor: '#2196F3' }}
                onPress={() => {
                  setModalVisible(!modalVisible);
                }}>
                <Text style={styles.textStyle}>Hide Modal</Text>
              </TouchableHighlight>
            </View>
          </View>
        </Modal>
  
      </View>
    );
  }
  
  const styles = StyleSheet.create({
    centeredView: {
      flex: 1,
      justifyContent: 'center',
      alignItems: 'center',
      marginTop: 22,
    },
    modalView: {
      margin: 20,
      backgroundColor: 'white',
      borderRadius: 20,
      padding: 35,
      alignItems: 'center',
      shadowColor: '#000',
      shadowOffset: {
        width: 0,
        height: 2,
      },
      shadowOpacity: 0.25,
      shadowRadius: 3.84,
      elevation: 5,
    },
    openButton: {
      backgroundColor: '#F194FF',
      borderRadius: 20,
      padding: 10,
      elevation: 2,
    },
    textStyle: {
      color: 'white',
      fontWeight: 'bold',
      textAlign: 'center',
    },
    modalText: {
      marginBottom: 15,
      textAlign: 'center',
    },
  });
  */
